<?php

namespace App\Http\Controllers\Modules\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\ArticleRole;
use stdClass;

class ArticleRolesController extends Controller
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
     * List article roles
     * POST /admin/articles/roles
     */
    public function get(Request $request)
    {
        $data = new stdClass();
        $data->roles = ArticleRole::get();

        return $this->responseJson(true, 'list article roles', $data);
    }
}
