<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_permissions';

    /**
     * Make the search engine logic on the main page
     * Receive the parameters of the list method on PermissionController
     *
     * per = Permission
     */
    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->where('per.name', "LIKE", "%$search%")
                ->orWhere('per.description', "LIKE", "%$search%");
        }
    }

    public function scopeModules($query, $value)
    {
        if (trim($value) != "") {
            $query->where('per.module_id', "$value");
        }
    }
}
