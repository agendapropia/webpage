<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'store_type_id',
        'store_status_id',
        'city_id',
        'uuid',
        'name',
        'name_short',
        'details',
        'address',
        'phone_code',
        'phone_number',
        'latitude',
        'longitude',
        'icon',
        'image',
    ];
    
    // - - - - - - - - - - - - Filters - - - - - - - - - - - - -

    /**
     * Status scope
     */
    public function scopeStatus($query, $value)
    {
        if (trim($value) != '') {
            $query->where('s.store_status_id', $value);
        }
    }

    /**
     * Search scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query
                ->where('s.uuid', $value)
                ->orWhere('s.name', 'like', '%'.$value.'%');
        }
    }

    /**
     * StoreTypes scope
     */
    public function scopeStoretypes($query, $value)
    {
        if (trim($value) != '') {
            $query->where('s.store_type_id', $value);
        }
    }
}
