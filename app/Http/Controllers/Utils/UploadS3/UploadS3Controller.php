<?php
namespace App\Http\Controllers\Utils\UploadS3;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Utils\File;
use Illuminate\Support\Facades\Storage;

use Image;

class UploadS3Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy_files(Request $request)
    {
        $name = $_POST['name'];
        $type = $_POST['type'];

        if ($type == 1) {
            $path = 'files/images/' . $name;
            Storage::disk('s3')->delete($path);

            $path = 'files/images/thumbnails/' . $name;
            Storage::disk('s3')->delete($path);
        } else {
            $path = 'files/documents/' . $name;
            Storage::disk('s3')->delete($path);
        }
    }

    public function upload_files(Request $request)
    {
        if ($request->hasFile('file')) {
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $name = $_POST['file_name'] . '.' . $ext;
            $state = $_POST['file_type'];

            $file = $request->file('file');

            if ($state == 1) {
                $image_thumb = Image::make($file)
                    ->widen(240, function ($constraint) {
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension());

                Storage::disk('s3')->put(
                    'files/images/' . $name,
                    fopen($file, 'r+'),
                    'public'
                );
                Storage::disk('s3')->put(
                    'files/images/thumbnails/' . $name,
                    (string) $image_thumb,
                    'public'
                );
            } else {
                // documents
                Storage::disk('s3')->put(
                    'files/documents/' . $name,
                    fopen($file, 'r+')
                );
            }
        }
    }

    /** Obtnere URL TEMPORAL del Archivo */
    public function getFile(Request $request)
    {
        $type = $request->get('_type');

        if ($type == 1) {
            $file = File::findOrFail($request->get('_id'));
            $nameFile = $file->name_tmp;

            if ($file) {
                if ($file->public == 2) {
                    return 'NOT PUBLUC';
                }
            } else {
                return 'NOT FILE';
            }
        } else {
            $nameFile = $request->get('_id');
        }

        if ($request->ajax()) {
            return response()->json([
                'data' => $this->getFileTemp($nameFile),
            ]);
        }
    }

    /** Obtnere URL TEMPORAL del Archivo */
    public function getFilePublic(Request $request)
    {
        $nameFile = $request->get('_id');

        if ($request->ajax()) {
            return response()->json([
                'data' => $this->getFileTemp($nameFile),
            ]);
        }
    }
}
