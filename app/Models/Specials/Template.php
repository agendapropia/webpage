<?php

namespace App\Models\Specials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
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
    protected $fillable = ['id', 'name', 'slug'];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('t.name', 'like', "%$value%");
        }
    }
}
