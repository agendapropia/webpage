<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const IMAGE_DEFAULT = null;
    const FILE_DEFAULT = 'default.png';
    const PATH_FILES = 'https://s3-us-west-1.amazonaws.com/germith/files/photos/';

    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_utils';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'imagen_type_id',
        'user_id',
        'creator_user_id',
        'source',
        'name',
        'description',
        'author',
    ];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('i.name', 'like', "%$value%");
        }
    }

    /**
     * create file util
     */
    static function createFile($file, $user, $private = false)
    {
        $fileType = FileType::where(
            'extension',
            strtolower($file->ext)
        )->first();

        $fileTypeId = 1;
        if ($fileType) {
            $fileTypeId = $fileType->id;
        }

        $fileAdd = new File();
        $fileAdd->file_type_id = $fileTypeId;
        $fileAdd->private = $private;
        $fileAdd->name = $file->name;
        $fileAdd->name_tmp = $file->name_tmp;
        $fileAdd->size = $file->size;
        $fileAdd->ext = $file->ext;
        $fileAdd->type = $file->type_file;
        $fileAdd->description = $file->description;
        $fileAdd->user_id = $user->id;
        if (isset($file->author->id) && $file->author->id != null) {
            $fileAdd->creator_user_id = $file->author->id;
            $fileAdd->author = $file->author->name;
        }
        $fileAdd->save();

        return $fileAdd;
    }

    /**
     * update file util
     */
    static function updateFile($id, $name_tmp, $file)
    {
        if ($id) {
            $fileUpdate = File::findOrFail($id);
        } else {
            $fileUpdate = File::where('name_tmp', $name_tmp)->first();
        }

        if (!$fileUpdate) {
            return false;
        }

        $fileUpdate->name = $file->name;
        $fileUpdate->description = $file->description;
        if (isset($file->author->id) && $file->author->id != null) {
            $fileUpdate->creator_user_id = $file->author->id;
            $fileUpdate->author = $file->author->name;
        }
        $fileUpdate->save();
    }

    static function setPathAndImageDefault($array)
    {
        foreach ($array as &$value) {
            if (empty($value->file)) {
                $value->file = self::FILE_DEFAULT;
            }

            $value->thumbnail_file =
                self::PATH_FILES . 'thumbnails/' . $value->file;
            $value->file = self::PATH_FILES . $value->file;
        }
        return $array;
    }
}
