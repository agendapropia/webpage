<?php

namespace App\Http\Controllers\Modules\Permissions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use App\Models\Permissions\PermissionModule;

class PermissionsController extends Controller
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
     * Show the module permissions.
     * GET /accounts/permissions
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modules = PermissionModule::get();
        return view('pages.admin.permissions.permissions', compact('modules'));
    }

    /**
     * List permissions
     * GET /accounts/permissions/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');
        $modules = $request->get('_modules');

        $permissions = Permission::select(
            'per.id',
            'per.name',
            'per.description',
            'm.name as name_module',
            'module_id',
            'per.guard_name'
        )
            ->from('permissions as per')
            ->search($search)
            ->modules($modules)
            ->join('permission_modules as m', 'm.id', 'per.module_id')
            ->orderBy('per.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list permissions', $permissions);
    }

    /**
     * Get data form create
     * GET /accounts/permissions/create
     */
    public function getDataCreate(Request $request)
    {
        $modules = PermissionModule::get();

        return $this->responseJson(true, 'data', [
            'modules' => $modules
        ]);
    }

    /**
     * Create permission
     * POST /accounts/permissions
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:30',
            'guard_name' => 'required|max:10',
            'description' => 'required|string|max:255',
            'module_id' => 'required|integer',
        ]);

        /** create permission  */
        $permission = Permission::create($request->all());
        $permission->save();

        return $this->responseJson(true, 'permission created', $permission);
    }

    /**
     * Update Permission
     * PUT /accounts/permission
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|max:255',
            'guard_name' => 'required|max:255',
            'module_id' => 'required|integer',
        ]);

        $permission = Permission::find($request->id);
        if(!$permission){
            return  response()->json([
                'status' => false,
                'message' => 'Permission not found',
                'data' => null
            ]);
        }

        $permission->fill($request->all());
        $permission->save();

        return $this->responseJson(true, 'permission update', $permission);

    }
}
