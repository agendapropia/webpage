<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\AlliedMedia;
use App\Models\Specials\Special;
use App\Models\Specials\SpecialContent;
use App\Models\Utils\File;
use App\Models\Utils\Language;
use Illuminate\Support\Facades\Auth;

class SpecialContentsController extends Controller
{
    const FROM_TABLE_MAIN = 'special_contents as sc';
    const LANGUAGE_DEFAULT = 1;
    const STATUS_EDIT = 2;
    const STATUS_OK = 1;

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
    public function index($specialSlug)
    {
        $special = Special::where('slug', $specialSlug)->first();
        if (!$special) {
            return redirect()->route('module-special');
        }

        $languages = Language::get();

        $specialContent = SpecialContent::where('special_id', $special->id)
            ->where('language_id', self::LANGUAGE_DEFAULT)
            ->first();

        if (!$specialContent) {
            $specialContent = new SpecialContent();
            $specialContent->status_id = self::STATUS_EDIT;
            $specialContent->special_id = $special->id;
            $specialContent->special_id = $special->id;
            $specialContent->language_id = self::LANGUAGE_DEFAULT;
            $specialContent->title = $special->name;
            $specialContent->save();
        }

        return view(
            'pages.admin.specials.contents.index',
            compact('special', 'specialContent', 'languages')
        );
    }

    /**
     * Data modal update
     * GET /admin/specials/{$slug}/contents/update
     */
    public function updateInfo($slug, Request $request)
    {
        $request->validate([
            '_language_id' => 'integer|required',
        ]);

        $special = Special::where('slug', $slug)->first();
        if (!$special) {
            return redirect()->route('module-special');
        }

        $content = SpecialContent::where('special_id', $special->id)
            ->where('language_id', $request->_language_id)
            ->first();
        if(!$content){
            return $this->responseJson(false, 'update information', []);
        }

        $data = [
            'content' => $content,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/specials/{$slug}/contents
     */
    public function update($slug, Request $request)
    {
        $request->validate([
            '_language_id' => 'integer|required',
            '_content' => 'string|nullable',
        ]);

        $special = Special::where('slug', $slug)->first();
        if (!$special) {
            return $this->responseJson(false, 'special not found');
        }

        $content = SpecialContent::where('special_id', $special->id)
            ->where('language_id', $request->_language_id)
            ->first();
        if (!$content) {
            return $this->responseJson(false, 'special content not found');
        }

        $content->content = $request->_content;
        $content->save();

        return $this->responseJson(true, 'special content update');
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

        /** delete files */
        foreach (json_decode($request->get('files_delete')) as $file) {
            $fileDelete = AlliedMedia::findOrFail($file);
            $fileDelete->image = File::IMAGE_DEFAULT;
            $fileDelete->save();
        }

        /** create new files */
        foreach (json_decode($request->get('files')) as $file) {
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

        return $this->responseJson(true, 'files created.', []);
    }
}
