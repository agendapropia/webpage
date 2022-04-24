<?php

namespace App\Http\Controllers\Modules\Menus\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menus\Category;
use App\Models\Menus\StoreCategory;
use App\Models\Menus\Topping;
use App\Models\Stores\Store;
use App\Models\Stores\StoreType;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    const CATEGORY_IMAGE_DEFAULT = 'image.jpg';

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
     * GET /menu-manager/categories
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores = Store::all();
        return view('modules.menus.categories.index', compact('stores'));
    }

    /**
     * List store
     * POST /menu-manager/categories/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');
        $status = $request->get('_status');
        $orderByColumn = $request->get('_order_by_column') ?? 'id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $categories = StoreCategory::select(
            'sc.id',
            'sc.status as status_id',
            DB::raw(
                '(CASE WHEN sc.status=1 THEN "fa-toggle-on" ELSE "fa-toggle-off" END) status'
            ),
            'sc.name',
            's.name as store_name',
            'c.name as category_name'
        )
            ->from('store_categories as sc')
            ->join('piddet_stores.stores as s', 'sc.store_id', 's.id')
            ->join('categories as c', 'sc.category_id', 'c.id')
            ->status($status)
            ->search($search)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        return $this->responseJson(true, 'list menu categories', $categories);
    }

    /**
     * Data modal create menu-categories
     * GET /menu-manager/categories/creation-information
     */
    public function createInformation(Request $request)
    {
        $stores = Store::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();

        $data = [
            'stores' => $stores,
            'categories' => $categories
        ];

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create menu categories
     * POST /menu-manager/categories
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'store_id' => 'required|integer',
            'name' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        /** menu category creation */
        $category = new StoreCategory($request->all());
        $category->status = true;
        $category->save();

        return $this->responseJson(true, 'category created', $category);
    }

    /**
     * Data modal update menu categories
     * GET /menu-manager/categories/update-information
     */
    public function updateInformation(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $stores = Store::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $category = StoreCategory::where('id', $request->_id)->first();

        $data = [
            'category' => $category,
            'stores' => $stores,
            'categories' => $categories
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update menu categories
     * PUT /menu-manager/categories
     */
    public function update(Request $request)
    {
        $request->validate([
            'store_id' => 'required|integer',
            'name' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $category = StoreCategory::find($request->id);
        if (!$category) {
            $this->responseJson(false, 'menu category not found');
        }

        $category->fill($request->all());
        $category->save();

        return $this->responseJson(true, 'menu category update', $category);
    }

    /**
     * Update status categories
     * PATCH /menu-manager/categories/status
     */
    public function changeStatus(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
            '_status' => 'required|integer',
        ]);

        $status = $request->_status ? 0 : 1;
        $category = StoreCategory::where('id', $request->_id)->update([
            'status' => $status,
        ]);
        if (!$category) {
            $this->responseJson(false, 'category not found');
        }

        return $this->responseJson(true, 'category status update', $category);
    }
}
