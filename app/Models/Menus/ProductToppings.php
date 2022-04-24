<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToppings extends Model
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
    protected $table = 'product_toppings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'status',
        'product_id',
        'product_group_id',
        'topping_id',
        'price',
        'position',
    ];
}
