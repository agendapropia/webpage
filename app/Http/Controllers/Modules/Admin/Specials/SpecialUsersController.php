<?php

namespace App\Http\Controllers\Modules\Admin\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\SpecialUser;
use App\Models\Utils\File;

class SpecialUsersController extends Controller
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
     * Create special user
     * POST /admin/specials/users
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'special_id' => 'required|integer',
            'special_role_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $specialUser = SpecialUser::where('special_id', $request->special_id)
            ->where('special_role_id', $request->special_role_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($specialUser) {
            return $this->responseJson(
                false,
                'the user and role already exist.',
                []
            );
        }

        $new = new SpecialUser($request->all());
        $new->save();

        return $this->responseJson(true, 'special created.', $new);
    }

    /**
     * Delete special user
     * DELETE /admin/specials/users
     */
    public function delete(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $specialUser = SpecialUser::where('id', $request->_id)->first();
        if (!$specialUser) {
            return $this->responseJson(
                false,
                'the user and role not exist.',
                []
            );
        }

        $specialUser->delete();

        return $this->responseJson(true, 'special users deleted.', []);
    }

    /**
     * List special users
     * POST /admin/special/users/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $orderByColumn = $request->get('_order_by_column') ?? 'su.id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $specialUsers = SpecialUser::select(
            'su.id',
            'u.id as user_id',
            'u.first_name as user_first_name',
            'u.last_name as user_last_name',
            'u.image as file',
            'sr.id as role_id',
            'sr.name as role_name'
        )
            ->from('special_users as su')
            ->join('special_roles as sr', 'su.special_role_id', 'sr.id')
            ->join('agendapropia_users.users as u', 'su.user_id', 'u.id')
            ->where('su.special_id', $request->_id)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        $specialUsers = File::setPathAndImageDefault($specialUsers, 2);

        return $this->responseJson(true, 'list special users', $specialUsers);
    }
}
