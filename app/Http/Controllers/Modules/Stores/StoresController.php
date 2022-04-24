<?php

namespace App\Http\Controllers\Modules\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Locations\City;
use App\Models\Permissions\Role;
use App\Models\Stores\Store;
use App\Models\Stores\StoreStatus;
use App\Models\Stores\StoreType;
use App\Models\Users\Country;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
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
     * Show the module stores.
     * GET /store-manager/stores
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $store_types = StoreType::all();
        return view('modules.stores.index', compact('store_types'));
    }

    /**
     * List store
     * POST /store-manager/stores/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $status = $request->get('_status');
        $search = $request->get('_search');
        $storeTypes = $request->get('_store_types');
        $orderByColumn = $request->get('_order_by_column') ?? 'id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $stores = Store::select(
            's.id',
            's.store_status_id as status_id',
            DB::raw(
                '(CASE WHEN s.store_status_id=1 THEN "fa-toggle-on" ELSE "fa-toggle-off" END) status'
            ),
            's.name',
            's.name_short',
            's.phone_code',
            's.phone_number',
            'st.name as store_type'
        )
            ->from('stores as s')
            ->join('store_types as st', 's.store_type_id', 'st.id')
            ->status($status)
            ->storetypes($storeTypes)
            ->search($search)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        return $this->responseJson(true, 'list store', $stores);
    }

    /**
     * List roles by store
     * POST /store-manager/store/{store_id}/roles
     */
    public function roles(Request $request, $store_id)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $roles = Role::select(
            'ro.id',
            'ro.name',
            'ro.description',
            'ro.guard_name',
            DB::raw(
                "(SELECT count(has.role_id) FROM model_has_roles as has WHERE has.role_id = ro.id and has.model_id = {$store_id}) as role"
            )
        )
            ->from('roles as ro')
            ->search($search)
            ->orderBy('ro.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list roles', $roles);
    }

    /**
     * Assign roles by store
     * POST /store-manager/store/{store_id}/assign
     */
    public function assign(Request $request, $store_id)
    {
        $remove = $request->_remove ? explode(',', $request->_remove) : [];
        $add = $request->_add ? explode(',', $request->_add) : [];

        $store = Store::find($store_id);

        foreach ($add as $id) {
            $role = Role::find($id);
            $store->assignRole($role->name);
        }

        foreach ($remove as $id) {
            $role = Role::find($id);
            $store->removeRole($role->name);
        }

        return $this->responseJson(true, 'assing role', $store_id);
    }

    /**
     * Data modal create store
     * GET /store-manager/stores/create
     */
    public function createInfo(Request $request)
    {
        $storeTypes = StoreType::select('id', 'name')->get();
        $storeStatus = StoreStatus::select('id', 'name')->get();
        $cities = City::select('id', 'name')->get();
        $countries = Country::select(
            'country_code as id',
            'country_code as name'
        )->get();

        $data = [
            'store_types' => $storeTypes,
            'store_status' => $storeStatus,
            'countries' => $countries,
            'cities' => $cities,
        ];

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create store
     * POST /store-manager/stores
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'store_type_id' => 'required|integer',
            'store_status_id' => 'required|integer',
            'city_id' => 'required|integer',
            'name' => 'required|string',
            'name_short' => 'required|string|max:15',
            'details' => 'required|string',
            'address' => 'required|string',
            'phone_code' => 'required|integer',
            'phone_number' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'icon' => 'required|string',
            'image' => 'required|string',
        ]);

        /** storename */
        $storename = $this->getUuidStore(
            $request->name_short,
            $request->details
        );
        if (!$storename) {
            $this->responseJson(false, 'error storename');
        }

        /** store creation */
        $store = new Store($request->all());
        $store->uuid = $storename;
        $store->save();

        return $this->responseJson(true, 'store created', $store);
    }

    /**
     * get storename
     */
    protected function getUuidStore($name, $other)
    {
        $first = substr(strtolower($name), 0, 1);
        $last = strtolower($other);
        $slug_text = $first . $last;
        $slug = preg_replace('([^A-Za-z0-9])', '', $slug_text);

        $validate = false;
        $slug_query = $slug;
        for ($i = 1; $i < 21; $i++) {
            if (
                !Store::select('id')
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
     * Data modal update store
     * GET /store-manager/stores/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $store = Store::find($request->_id);
        $storeTypes = StoreType::select('id', 'name')->get();
        $storeStatus = StoreStatus::select('id', 'name')->get();
        $cities = City::select('id', 'name')->get();
        $countries = Country::select(
            'country_code as id',
            'country_code as name'
        )->get();

        $data = [
            'store' => $store,
            'store_types' => $storeTypes,
            'store_status' => $storeStatus,
            'countries' => $countries,
            'cities' => $cities,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update Store
     * PUT /store-manager/stores
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'store_type_id' => 'required|integer',
            'store_status_id' => 'required|integer',
            'city_id' => 'required|integer',
            'name' => 'required|string',
            'name_short' => 'required|string|max:15',
            'details' => 'required|string',
            'address' => 'required|string',
            'phone_code' => 'required|integer',
            'phone_number' => 'required|min:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'icon' => 'required|string',
            'image' => 'required|string',
        ]);

        $store = Store::find($request->id);
        if (!$store) {
            $this->responseJson(false, 'store not found');
        }

        $store->fill($request->all());
        $store->save();

        return $this->responseJson(true, 'store update', $store);
    }

    /**
     * Update status store
     * PATCH /store-manager/stores/status
     */
    public function status(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
            '_status' => 'required|integer',
        ]);

        $status = $request->_status == 0 ? 2 : 1;

        $store = Store::where('id', $request->_id)->update([
            'store_status_id' => $status,
        ]);

        if (!$store) {
            $this->responseJson(false, 'store not found');
        }

        return $this->responseJson(true, 'store status update', $store);
    }

    /**
     * GET search by autocomplete
     * POST /store-manager/stores/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $stores = Store::select(
            's.id',
            's.name',
            's.image'
        )
            ->from('stores as s')
            ->status(1)
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list store', $stores);
    }
}
