<?php

namespace App\Http\Controllers\Modules\Configurations\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\Country;
use App\Models\Utils\Region;
use App\Models\Utils\Tag;

class TagsController extends Controller
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
     * Show the module tags.
     * GET /configurations/tags
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.configurations.tags.index');
    }

    /**
     * List tags
     * POST /configurations/tags/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $regions = Tag::select('t.id', 't.name', 't.code')
            ->from('tags as t')
            ->search($search)
            ->orderBy('t.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list tags', $regions);
    }

    /**
     * Data modal create tag
     * GET /configurations/tags/create
     */
    public function createInfo(Request $request)
    {
        return $this->responseJson(true, 'create information', []);
    }

    /**
     * Create tag
     * POST /configurations/tags
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'max:50',
        ]);

        /** tag creation */
        $tag = new Tag($request->all());
        $tag->image = 'image.png';
        $tag->save();

        return $this->responseJson(true, 'tag created', $tag);
    }

    /**
     * Data modal update
     * GET /configurations/tags/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $tag = Tag::find($request->_id);

        $data = [
            'tag' => $tag,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /configurations/tags
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'code' => 'max:100',
        ]);

        $tag = Tag::find($request->id);
        if (!$tag) {
            $this->responseJson(false, 'tag not found');
        }

        $tag->fill($request->all());
        $tag->save();

        return $this->responseJson(true, 'tag update', $tag);
    }
}
