<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\SpecialFile;
use App\Models\Specials\SpecialUser;
use App\Models\Utils\File;
use App\Models\Utils\FileType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpecialFilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function get(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
            '_type' => 'required|integer',
        ]);

        $files = SpecialFile::select(
            'sf.id',
            'sf.special_id',
            'f.name',
            'f.name_tmp',
            'f.creator_user_id as author_id',
            'f.author as author_name',
            'f.description',
            'f.ext'
        )
            ->from('special_files as sf')
            ->join('agendapropia_utils.files as f', 'f.id', 'sf.file_id')
            ->where('sf.special_id', $request->_id)
            ->where('sf.type', $this->getSpecialFileType($request->_type))
            ->orderBy('sf.position', 'ASC')
            ->get();

        return $this->responseJson(true, 'special files', $files);
    }

    /**
     * Create special files
     * POST /admin/specials/files
     */
    public function create(Request $request)
    {
        $request->validate([
            'external_id' => 'required|integer',
            'source_id' => 'required|integer',
            'files' => 'required|nullable',
            'files_delete' => 'required|nullable',
        ]);

        $user = Auth::user();

        $id = $request->get('id');
        $specialfileType = $this->getSpecialFileType(
            $request->get('source_id')
        );

        $files = json_decode($request->get('files'));
        $files_delete = json_decode($request->get('files_delete'));

        /** create new files */
        foreach ($files as $file) {
            if ($file->type == 1) {
                $fileType = FileType::where(
                    'extension',
                    strtolower($file->ext)
                )->first();

                $fileTypeId = 1;
                if ($fileType) {
                    $fileTypeId = $fileType->id;
                }

                $file_add = new File();
                $file_add->file_type_id = $fileTypeId;
                $file_add->name = $file->name;
                $file_add->name_tmp = $file->name_tmp;
                $file_add->size = $file->size;
                $file_add->ext = $file->ext;
                $file_add->type = $file->type_file;
                $file_add->description = $file->description;
                $file_add->user_id = $user->id;
                if (isset($file->author->id) && $file->author->id != null) {
                    $file_add->creator_user_id = $file->author->id;
                    $file_add->author = $file->author->name;
                }
                $file_add->save();

                $fileAdd = new SpecialFile();
                $fileAdd->special_id = $id;
                $fileAdd->file_id = $file_add->id;
                $fileAdd->position = $file->order;
                $fileAdd->type = $specialfileType;
                $fileAdd->save();
            } else {
                $specialFileUpdate = SpecialFile::findOrFail($file->id);
                $specialFileUpdate->position = $file->order;
                $specialFileUpdate->save();

                $fileUpdate = File::findOrFail($specialFileUpdate->file_id);
                $fileUpdate->name = $file->name;
                $fileUpdate->description = $file->description;
                $fileUpdate->user_id = $user->id;
                if (isset($file->author->id) && $file->author->id != null) {
                    $fileUpdate->creator_user_id = $file->author->id;
                    $fileUpdate->author = $file->author->name;
                }
                $fileUpdate->save();
            }
        }

        /**
         * delete files
         */
        foreach ($files_delete as $file) {
            $fileDelete = SpecialFile::findOrFail($file);
            $file_delete = File::findOrFail($fileDelete->file_id);

            if ($file_delete->type == 1) {
                $path = 'files/photos/' . $file_delete->name_tmp;
                Storage::disk('s3')->delete($path);
                $path = 'files/photos/thumbnails/' . $file_delete->name_tmp;
                Storage::disk('s3')->delete($path);
            } elseif ($file_delete->type == 2) {
                $path = 'files/documents/' . $file_delete->name_tmp;
                Storage::disk('s3')->delete($path);
            }

            $fileDelete->delete();
            $file_delete->delete();
        }

        return $this->responseJson(true, 'special files created.', []);
    }

    protected function getSpecialFileType(int $id)
    {
        if ($id == 1) {
            return SpecialFile::TYPE_COVER;
        } else {
            return SpecialFile::TYPE_SUMMARY;
        }
    }
}
