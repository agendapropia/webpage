<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\AlliedMedia;

class AlliedMediaController extends Controller
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
     * POST /specials/allied-media/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $alliedMedia = AlliedMedia::select('am.id', 'am.name')
            ->from('allied_media as am')
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list alliedMedia', $alliedMedia);
    }
}
