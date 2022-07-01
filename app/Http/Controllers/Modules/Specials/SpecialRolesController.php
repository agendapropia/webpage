<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\SpecialRole;
use stdClass;

class SpecialRolesController extends Controller
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
     * List special roles
     * POST /admin/specials/roles
     */
    public function get(Request $request)
    {
        $data = new stdClass();
        $data->roles = SpecialRole::get();

        return $this->responseJson(true, 'list special roles', $data);
    }
}
