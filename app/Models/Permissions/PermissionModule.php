<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    use HasFactory;
    
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
}
