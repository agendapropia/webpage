<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_menu';

    /**
     * The table name for the model.
     *
     * @var string
     */
    protected $table = 'store_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'status', 'store_id', 'category_id', 'name'];

    // - - - - - - - - - - - - Filters - - - - - - - - - - - - -

    /**
     * Status scope
     */
    public function scopeStatus($query, $value)
    {
        if (trim($value) != '') {
            $query->where('sc.status', $value);
        }
    }

    /**
     * Search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query->where('sc.name', 'like', "%{$value}%");
        }
    }
}
