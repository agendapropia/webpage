<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
    protected $fillable = [
        'id',
        'slug',
        'status_id',
        'special_id',
        'article_type_id',
        'name',
        'publication_date',
        'number_views',
    ];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('a.name', 'like', "%$value%");
        }
    }

    public function scopeSpecial($query, $value)
    {
        if (trim($value) != '') {
            $query->where('a.special_id', $value);
        }
    }

    public function scopeStatus($query, $value)
    {
        if (trim($value) != '') {
            $query->where('a.status_id', $value);
        }
    }
}
