<?php

namespace App\Http\Controllers\Modules\Permissions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
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
     * Show the module roles.
     * GET /accounts/roles
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.permissions.roles');
    }

    /**
     * List roles
     * POST /accounts/roles/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $roles = Role::select(
            'ro.id',
            'ro.name',
            'ro.description',
            'ro.guard_name'
        )
            ->from('roles as ro')
            ->search($search)
            ->orderBy('ro.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list roles', $roles);
    }

    /**
     * List permissions by roles
     * GET /accounts/roles/{role_id}/permissions
     */
    public function permissions(Request $request, $role_id)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');
        $modules = $request->get('_modules');

        $roles = Permission::select(
            'per.id',
            'per.name',
            'per.description',
            'm.name as name_module',
            'module_id',
            'per.guard_name',
            DB::raw(
                "(SELECT count(has.permission_id) FROM role_has_permissions as has WHERE has.permission_id = per.id and has.role_id = $role_id) as role"
            )
        )
            ->from('permissions as per')
            ->search($search)
            ->modules($modules)
            ->join('permission_modules as m', 'm.id', 'per.module_id')
            ->orderBy('per.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list roles', $roles);
    }

    /**
     * Assign permissions by roles
     * POST /accounts/roles/{role_id}/assign
     */
    public function assign(Request $request, $role_id)
    {
        $remove = $request->_remove ? explode(',', $request->_remove) : [];
        $add = $request->_add ? explode(',', $request->_add) : [];

        $role = Role::find($role_id);

        foreach ($add as $id) {
            $permission = Permission::find($id);
            $permission->assignRole($role);
        }

        foreach ($remove as $id) {
            $permission_r = Permission::find($id);
            $permission_r->removeRole($role);
        }

        return $this->responseJson(true, 'assig permission to roles', $role_id);
    }

    /**
     * Create role
     * POST /accounts/roles
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:30',
            'guard_name' => 'required|max:10',
            'description' => 'required|string|max:255',
        ]);

        /** role  */
        $role = Role::create($request->all());
        $role->save();

        return $this->responseJson(true, "role created", $role);
    }

    /**
     * Update Roles
     * PUT /accounts/roles
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|max:255',
            'guard_name' => 'required|max:255',
        ]);

        $role = Role::find($request->id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found',
                'data' => null,
            ]);
        }

        $role->fill($request->all());
        $role->save();

        return $this->responseJson(true, "role updated", $role);
    }
}
