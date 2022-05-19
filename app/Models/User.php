<?php

namespace App\Models;

use App\Models\Users\Term;
use App\Models\Users\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'status',
        'first_name',
        'last_name',
        'gender_id',
        'phone_code',
        'phone_number',
        'has_password',
        'password',
        'location',
        'term_accepted_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Get the user_profile associated with the user.
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get the terms associated with the user.
     */
    public function termAccepted()
    {
        return $this->hasOne(Term::class);
    }

    // - - - - - - - - - - - - Filters - - - - - - - - - - - - -

    /**
     * Status scope
     */
    public function scopeStatus($query, $value)
    {
        if (trim($value) != '') {
            $query->where('u.status', $value);
        }
    }

    /**
     * Status scope
     */
    public function scopeSearch($query, $value)
    {
        if (trim($value) != '') {
            $query
                ->where('u.uuid', $value)
                ->orWhere('u.last_name', 'like', "%$value%")
                ->orWhere('u.first_name', $value)
                ->orWhere('u.phone_code', $value);
        }
    }
}
