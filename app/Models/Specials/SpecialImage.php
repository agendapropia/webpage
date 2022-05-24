<?php

namespace App\Models\Specials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialImage extends Model
{
    use HasFactory;

    const TYPE_COVER = 'COVER';
    const TYPE_SUMMARY = 'SUMMARY';

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
    protected $fillable = ['id', 'special_id', 'image_id', 'type', 'position'];
}
