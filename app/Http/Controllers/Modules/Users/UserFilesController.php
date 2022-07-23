<?php

namespace App\Http\Controllers\Modules\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Utils\File;
use Illuminate\Support\Facades\Auth;

class UserFilesController extends Controller
{
    const FROM_TABLE_MAIN = 'users as u';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * list accounts user files
     * GET /admin/accounts/users/files
     */
    public function files(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $files = User::select(
            'u.id',
            'f.name',
            'f.name_tmp',
            'f.creator_user_id as author_id',
            'f.author as author_name',
            'f.description',
            'f.ext'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join('agendapropia_utils.files as f', 'f.name_tmp', 'u.image')
            ->where('u.id', $request->_id)
            ->get();

        return $this->responseJson(true, 'files', $files);
    }

    /**
     * Create accounts users files
     * POST /admin/accounts/users/files
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
            $fileDelete = User::findOrFail($file);
            $fileDelete->image = File::IMAGE_DEFAULT;
            $fileDelete->save();
        }

        /** create new files */
        foreach (json_decode($request->get('files')) as $file) {
            if ($file->type == 1) {
                File::createFile($file, $user, true);

                $alliedMediaUpdate = User::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();
            } else {
                $alliedMediaUpdate = User::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();

                File::updateFile(false, $file->name_tmp, $file);
            }
        }

        return $this->responseJson(true, 'files created.', []);
    }
}
