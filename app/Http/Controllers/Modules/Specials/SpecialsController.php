<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\Special;
use App\Models\Users\Country;
use App\Models\Utils\Region;
use Illuminate\Support\Facades\DB;

class SpecialsController extends Controller
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
     * Show the module specials.
     * GET /admin/specials
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.specials.module.index');
    }

    /**
     * List specials
     * POST /admin/specials/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $specials = Special::select(
            's.id',
            's.name',
            's.publication_date',
            's.number_views',
            'ss.id as status_id', 
            'ss.name as status_name',
            'ss.label as status_label',
        )
            ->from('specials as s')
            ->join('special_status as ss', 'ss.id', 's.status_id')
            ->search($search)
            ->orderBy('s.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list specials', $specials);
    }

    /**
     * Data modal create special
     * GET /admin/specials/create
     */
    public function createInfo(Request $request)
    {
        return $this->responseJson(true, 'create information', []);
    }

    /**
     * Create user
     * POST /admin/specials
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:255',
            'country_id' => 'required|integer'
        ]);

        /** region creation */
        $region = new Region($request->all());
        $region->image = 'image.png';
        $region->icon = 'icon.png';
        $region->save();

        return $this->responseJson(true, 'region created', $region);
    }

    /**
     * Data modal update
     * GET /admin/specials/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $region = Region::find($request->_id);
        $country = Country::find($region->country_id);

        $data = [
            'region' => $region,
            'country' => $country
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/specials
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'country_id' => 'required|integer'
        ]);

        $region = Region::find($request->id);
        if (!$region) {
            $this->responseJson(false, 'region not found');
        }

        $region->fill($request->all());
        $region->save();

        return $this->responseJson(true, 'region update', $region);
    }
}
