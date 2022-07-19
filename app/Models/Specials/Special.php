<?php

namespace App\Models\Specials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
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
        'template_id',
        'name',
        'publication_date',
        'hidden',
        'number_views',
    ];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('s.name', 'like', "%$value%");
        }
    }
    public function scopeStatus($query, $value)
    {
        if (trim($value) != '') {
            $query->where('s.status_id', $value);
        }
    }

    // ----------- util methods -------------
    public function scopeGetDataBasic($query)
    {
        $query
            ->select('id', 'name')
            ->where('hidden', false);
    }
}
