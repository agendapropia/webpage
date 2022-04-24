<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
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
     * Receive the parameters of the list method on RoleController
     *
     * Query variables:
     * ro = Role
     */
    public function scopeSearch($query, $search)
    {
        if(trim($search) != "")
        {
            $query  ->where('ro.name', "LIKE", "%$search%")
                    ->orWhere('ro.description', "LIKE", "%$search%");
        }
    }
}
