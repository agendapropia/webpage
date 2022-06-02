<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
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
    protected $fillable = ['id', 'country_id', 'name', 'image', 'icon'];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('r.name', 'like', "%$value%");
        }
    }

    /**
     * country scope
     */
    public function scopeCountry($query, $value)
    {
        if (trim($value) != '') {
            $query->where('r.country_id', $value);
        }
    }
}
