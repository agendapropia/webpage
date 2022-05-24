<?php

namespace App\Models\Specials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialStatus extends Model
{
    use HasFactory;

    protected $table = 'special_status';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_articules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'icon', 'label'];

    /**
     * search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('ss.name', 'like', "%$value%");
        }
    }
}
