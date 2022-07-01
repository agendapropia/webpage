<?php

namespace App\Http\Controllers\Modules\Configurations\Countries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\Country;

class CountriesController extends Controller
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
     * GET search by autocomplete
     * POST /configurations/countries/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $countries = Country::select(
            'c.id',
            'c.name',
            'c.icon as image'
        )
            ->from('countries as c')
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list countries', $countries);
    }
}
