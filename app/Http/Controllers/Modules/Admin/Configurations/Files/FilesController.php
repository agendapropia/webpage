<?php

namespace App\Http\Controllers\Modules\Admin\Configurations\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\AlliedMedia;
use App\Models\Utils\File;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    const FROM_TABLE_MAIN = 'files as f';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the module files..n
     * GET /admin/files
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.specials.alliedmedia.index');
    }

    /**
     * List files
     * POST /admin/files/list
     */
    public function list(Request $request)
    { 
        $row = $request->get('_row') ?: 10;
        $search = $request->get('_search');
        $orderByKey = $request->get('_order_by_key') ?: 'am.id';
        $orderByType = $request->get('_order_by_type') ?: 'DESC';

        $alliedmedia = AlliedMedia::select(
            'am.id',
            'am.name',
            'am.url',
            'am.image as file'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->search($search)
            ->orderBy($orderByKey, $orderByType)
            ->paginate($row);

        $alliedmedia = File::setPathAndImageDefault($alliedmedia);

        return $this->responseJson(true, 'list files', $alliedmedia);
    }

    /**
     * Data modal create tag
     * GET /admin/files/create
     */
    public function createInfo(Request $request)
    {
        return $this->responseJson(true, 'create information', []);
    }

    /**
     * Create files
     * POST /admin/files
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required',
        ]);

        /** alliedmedia creation */
        $alliedmedia = new AlliedMedia($request->all());
        $alliedmedia->image = File::IMAGE_DEFAULT;
        $alliedmedia->save();

        return $this->responseJson(true, 'files created', $alliedmedia);
    }

    /**
     * Data modal update
     * GET /admin/files/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $alliedmedia = AlliedMedia::find($request->_id);

        $data = [
            'alliedmedia' => $alliedmedia,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/files
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'url' => 'required|string',
        ]);

        $alliedmedia = AlliedMedia::find($request->id);
        if (!$alliedmedia) {
            $this->responseJson(false, 'alliedmedia not found');
        }

        $alliedmedia->fill($request->all());
        $alliedmedia->save();

        return $this->responseJson(true, 'alliedmedia update', $alliedmedia);
    }

    /**
     * GET search by autocomplete
     * POST /admin/files/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $alliedMedia = AlliedMedia::select('am.id', 'am.name')
            ->from(self::FROM_TABLE_MAIN)
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list alliedMedia', $alliedMedia);
    }

    /**
     * list files files
     * GET /admin/files/items
     */
    public function files(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $files = AlliedMedia::select(
            'am.id',
            'f.name',
            'f.name_tmp',
            'f.creator_user_id as author_id',
            'f.author as author_name',
            'f.description',
            'f.ext'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join('agendapropia_utils.files as f', 'f.name_tmp', 'am.image')
            ->where('am.id', $request->_id)
            ->get();

        return $this->responseJson(true, 'files', $files);
    }

    /**
     * Create files
     * POST /admin/files/items
     */
    public function createFiles(Request $request)
    {
        $request->validate([
            'external_id' => 'required|integer',
            'source_id' => 'required|integer',
            'files' => 'required|nullable',
            'files_delete' => 'required|nullable',
        ]);

        $user = Auth::user();

        /** create new files */
        foreach (json_decode($request->get('files')) as $file) {
            if ($file->type == 1) {
                File::createFile($file, $user, true);
            } else {
                File::updateFile(false, $file->name_tmp, $file);
            }
        }

        return $this->responseJson(true, 'files created.', []);
    }
}
