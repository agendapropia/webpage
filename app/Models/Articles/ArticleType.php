<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
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
    protected $fillable = ['id', 'name', 'icon'];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('at.name', 'like', "%$value%");
        }
    }
}
