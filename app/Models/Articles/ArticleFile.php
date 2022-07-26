<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleFile extends Model
{
    use HasFactory;

    const TYPE_COVER = 'COVER';
    const TYPE_SUMMARY = 'SUMMARY';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'article_id', 'image_id', 'type', 'position'];

    // queries
    public function scopegetImageByType($query, $id, $type)
    {
        $query
            ->select(
                'f.name_tmp',
                'f.type',
                'f.ext',
                'f.description',
                'f.author'
            )
            ->from('article_files as af')
            ->join('agendapropia_utils.files as f', 'f.id', 'af.file_id')
            ->where('af.article_id', $id)
            ->where('af.type', $type);
    }
}
