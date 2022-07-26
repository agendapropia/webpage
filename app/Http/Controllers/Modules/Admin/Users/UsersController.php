<?php

namespace App\Http\Controllers\Modules\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permissions\Role;
use App\Models\User;
use App\Models\Users\Country;
use App\Models\Users\UserGender;
use App\Models\Utils\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the module users.
     * GET /accounts/users
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.users.index');
    }

    /**
     * List user
     * POST /accounts/users/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $status = $request->get('_status');
        $search = $request->get('_search');

        $users = User::select(
            'u.id',
            'u.status as status_id',
            DB::raw(
                '(CASE WHEN u.status=1 THEN "fa-toggle-on" ELSE "fa-toggle-off" END) status'
            ),
            'u.first_name',
            'u.last_name',
            'u.phone_code',
            'u.phone_number',
            'u.email',
            'u.location',
            'u.image as file'
        )
            ->from('users as u')
            ->status($status)
            ->search($search)
            ->orderBy('id', 'DESC')
            ->paginate($row);

        $users = File::setPathAndImageDefault($users, 2);

        return $this->responseJson(true, 'list user', $users);
    }

    /**
     * List roles by user
     * POST /accounts/user/{user_id}/roles
     */
    public function roles(Request $request, $user_id)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $roles = Role::select(
            'ro.id',
            'ro.name',
            'ro.description',
            'ro.guard_name',
            DB::raw(
                "(SELECT count(has.role_id) FROM model_has_roles as has WHERE has.role_id = ro.id and has.model_id = {$user_id}) as role"
            )
        )
            ->from('roles as ro')
            ->search($search)
            ->orderBy('ro.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list roles', $roles);
    }

    /**
     * Assign roles by user
     * POST /accounts/user/{user_id}/assign
     */
    public function assign(Request $request, $user_id)
    {
        $remove = $request->_remove ? explode(',', $request->_remove) : [];
        $add = $request->_add ? explode(',', $request->_add) : [];

        $user = User::find($user_id);

        foreach ($add as $id) {
            $role = Role::find($id);
            $user->assignRole($role->name);
        }

        foreach ($remove as $id) {
            $role = Role::find($id);
            $user->removeRole($role->name);
        }

        return $this->responseJson(true, 'assing role', $user_id);
    }

    /**
     * Data modal create user
     * GET /accounts/users/create
     */
    public function createInfo(Request $request)
    {
        $genders = UserGender::select('id', 'name')->get();
        $countries =  $this->_getCountriesMobile();

        $data = [
            'genders' => $genders,
            'countries' => $countries,
        ];

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create user
     * POST /accounts/users
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender_id' => 'required|integer',
            'phone_code' => 'required|min:1|integer',
            'phone_number' => 'required|min:10|unique:users',
            'email' => 'required|email|unique:users',
            'location' => 'required|string|in:es,en',
        ]);

        /** username */
        $username = $this->getUuidUser(
            $request->first_name,
            $request->last_name
        );
        if (!$username) {
            $this->responseJson(false, 'error username');
        }

        /** user creation */
        $user = new User($request->all());
        $user->status = 1;
        $user->password = Hash::make($request->phone_number);
        $user->uuid = $username;
        $user->term_accepted_id = 0;
        $user->has_password = 1;
        $user->save();

        return $this->responseJson(true, 'user created', $user);
    }

    /**
     * get username
     */
    protected function getUuidUser($first_name, $last_name)
    {
        $first = substr(strtolower($first_name), 0, 1);
        $last = strtolower($last_name);
        $slug_text = $first . $last;
        $slug = preg_replace('([^A-Za-z0-9])', '', $slug_text);

        $validate = false;
        $slug_query = $slug;
        for ($i = 1; $i < 21; $i++) {
            if (
                !User::select('id')
                    ->where('uuid', $slug_query)
                    ->first()
            ) {
                $validate = true;
                $slug = $slug_query;
                break;
            } else {
                $slug_query = $slug . $i;
            }
        }

        return $validate ? $slug : false;
    }

    /**
     * Data modal update user
     * GET /accounts/users/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $user = User::find($request->_id);
        $genders = UserGender::select('id', 'name')->get();
        $countries =  $this->_getCountriesMobile();

        $data = [
            'user' => $user,
            'genders' => $genders,
            'countries' => $countries,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update User
     * PUT /accounts/users
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender_id' => 'required|integer',
            'phone_code' => 'required|min:1|integer',
            'phone_number' =>
                'required|min:10|unique:users,phone_number,' . $request->id,
            'email' =>
                'required|max:160|email|unique:users,email,' . $request->id,
            'location' => 'required|string|in:es,en',
        ]);

        $user = User::find($request->id);
        if (!$user) {
            $this->responseJson(false, 'user not found');
        }

        $user->fill($request->all());
        $user->save();

        return $this->responseJson(true, 'user update', $user);
    }

    /**
     * Update status user
     * PATCH /accounts/users/status
     */
    public function status(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
            '_status' => 'required|integer',
        ]);

        $status = $request->_status ? 0 : 1;

        $user = User::where('id', $request->_id)->update([
            'status' => $status,
        ]);

        if (!$user) {
            $this->responseJson(false, 'user not found');
        }

        return $this->responseJson(true, 'user status update', $user);
    }

    /**
     * GET search by autocomplete
     * POST /users/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $alliedMedia = User::select(
            'u.id',
            DB::raw('CONCAT(u.first_name, " ",u.last_name) as name')
        )
            ->from('users as u')
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list user', $alliedMedia);
    }

    private function _getCountriesMobile()
    {
        return Country::select(
            'country_code as id',
            DB::raw('CONCAT("+", country_code, " (", name, ")") as name')
        )->get();
    }
}
