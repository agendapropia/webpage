<?php

namespace App\Http\Controllers\Modules\Admin\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\SpecialAlliedMediaRole;
use stdClass;

class SpecialAlliedMediaRolesController extends Controller
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
     * POST /admin/specials/allied-media/roles
     */
    public function get(Request $request)
    {
        $data = new stdClass();
        $data->roles = SpecialAlliedMediaRole::get();

        return $this->responseJson(true, 'list special allied media roles', $data);
    }
}
