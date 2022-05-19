<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\AlliedMedia;
use App\Models\Users\Country;
use App\Models\Utils\File;
use App\Models\Utils\FileType;
use App\Models\Utils\Region;
use App\Models\Utils\Tag;
use Illuminate\Support\Facades\Auth;

class AlliedMediaController extends Controller
{
    const FROM_TABLE_MAIN = 'allied_media as am';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the module allied media.
     * GET /admin/specials/allied-media
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.specials.alliedmedia.index');
    }

    /**
     * List allied media
     * POST /admin/specials/allied-media/list
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

        return $this->responseJson(true, 'list allied media', $alliedmedia);
    }

    /**
     * Data modal create tag
     * GET /admin/specials/allied-media/create
     */
    public function createInfo(Request $request)
    {
        return $this->responseJson(true, 'create information', []);
    }

    /**
     * Create allied media
     * POST /admin/specials/allied-media
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

        return $this->responseJson(true, 'allied media created', $alliedmedia);
    }

    /**
     * Data modal update
     * GET /admin/specials/allied-media/update
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
     * PUT /admin/specials/allied-media
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
     * POST /admin/specials/allied-media/search-by-autocomplete
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
     * Create allied media files
     * POST /admin/specials/allied-media/files
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
        $id = $request->get('id');

        $files = json_decode($request->get('files'));
        $files_delete = json_decode($request->get('files_delete'));

        /** create new files */
        foreach ($files as $file) {
            if ($file->type == 1) {
                File::createFile($file, $user, true);

                $alliedMediaUpdate = AlliedMedia::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();
            } else {
                $alliedMediaUpdate = AlliedMedia::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();

                File::updateFile(false, $file->name_tmp, $file);
            }
        }

        /**
         * delete files
         */
        foreach ($files_delete as $file) {
            $fileDelete = AlliedMedia::findOrFail($file);
            $fileDelete->image = File::IMAGE_DEFAULT;
            $fileDelete->save();
        }

        return $this->responseJson(true, 'files created.', []);
    }

    /**
     * list allied media files
     * GET /admin/specials/allied-media/files
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
}
