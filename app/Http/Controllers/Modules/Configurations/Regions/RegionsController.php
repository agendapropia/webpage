<?php

namespace App\Http\Controllers\Modules\Configurations\Regions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users\Country;
use App\Models\Users\UserGender;
use App\Models\Utils\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegionsController extends Controller
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
     * Show the module regions.
     * GET /configurations/regions
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.configurations.regions.index');
    }

    /**
     * List regions
     * POST /configurations/regions/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $regions = Region::select(
            'r.id',
            'r.name',
            'r.country_id',
            'c.name as country_name'
        )
            ->from('regions as r')
            ->join('agendapropia_users.countries as c', 'c.id', 'r.country_id')
            ->search($search)
            ->orderBy('r.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list regions', $regions);
    }

    /**
     * Data modal create region
     * GET /configurations/regions/create
     */
    public function createInfo(Request $request)
    {
        return $this->responseJson(true, 'create information', []);
    }

    /**
     * Create user
     * POST /configurations/regions
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
     * GET /configurations/regions/update
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
     * PUT /configurations/regions
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
