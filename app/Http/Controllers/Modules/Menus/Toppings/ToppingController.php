<?php

namespace App\Http\Controllers\Modules\Menus\Toppings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Locations\City;
use App\Models\Menus\Topping;
use App\Models\Stores\Store;
use App\Models\Stores\StoreStatus;
use App\Models\Stores\StoreType;
use App\Models\Users\Country;
use Illuminate\Support\Facades\DB;

class ToppingController extends Controller
{
    const TOPPING_IMAGE_DEFAULT = 'image.png';

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
        return view('modules.menus.toppings.index', compact('store_types'));
    }

    /**
     * List store
     * POST /store-manager/stores/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');
        $status = $request->get('_status');
        $orderByColumn = $request->get('_order_by_column') ?? 'id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $toppings = Topping::select(
            't.id',
            't.status as status_id',
            DB::raw(
                '(CASE WHEN t.status=1 THEN "fa-toggle-on" ELSE "fa-toggle-off" END) status'
            ),
            't.name',
            DB::raw('SUBSTRING(t.description,1, 20) description'),
            's.name as name_store',
            DB::raw(
                'CONCAT("' .
                    config('filesystems.disks.s3.url') .
                    '", "thumbnails/", t.image) image'
            )
        )
            ->from('toppings as t')
            ->join('piddet_stores.stores as s', 't.store_id', 's.id')
            ->status($status)
            ->search($search)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        return $this->responseJson(true, 'list menu toppings', $toppings);
    }

    /**
     * Data modal create menu-topping
     * GET /menu-manager/topping/creation-information
     */
    public function createInformation(Request $request)
    {
        $stores = Store::select('id', 'name')->get();

        $data = [
            'stores' => $stores,
        ];

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create menu topping
     * POST /menu-manager/toppings
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'store_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        /** menu topping creation */
        $topping = new Topping($request->all());
        $topping->status = true;
        $topping->image = self::TOPPING_IMAGE_DEFAULT;
        $topping->save();

        return $this->responseJson(true, 'store created', $topping);
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
     * Data modal update menu topping
     * GET /menu-manager/toppings/update-information
     */
    public function updateInformation(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $stores = Store::select('id', 'name')->get();
        $topping = Topping::where('id', $request->_id)->first();

        $data = [
            'topping' => $topping,
            'stores' => $stores,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update menu topping
     * PUT /menu-manager/toppings
     */
    public function update(Request $request)
    {
        $request->validate([
            'store_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $topping = Topping::find($request->id);
        if (!$topping) {
            $this->responseJson(false, 'menu topping not found');
        }

        $topping->fill($request->all());
        $topping->save();

        return $this->responseJson(true, 'menu topping update', $topping);
    }

    /**
     * Update status topping
     * PATCH /menu-manager/toppings/status
     */
    public function changeStatus(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
            '_status' => 'required|integer',
        ]);

        $status = $request->_status ? 0 : 1;
        $topping = Topping::where('id', $request->_id)->update([
            'status' => $status,
        ]);
        if (!$topping) {
            $this->responseJson(false, 'topping not found');
        }

        return $this->responseJson(true, 'topping status update', $topping);
    }
}
