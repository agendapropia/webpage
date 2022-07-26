<?php

namespace App\Models;

use App\Models\Users\Term;
use App\Models\Users\UserProfile;
use App\Models\Utils\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    const DB_TABLE = 'agendapropia_users.users as u';

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
        'image',
        'gender_id',
        'phone_code',
        'phone_number',
        'email',
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

    /**
     * Get the user image.
     */
    public function getUserImage(User $user)
    {
        return File::setPathAndImageDefaultUnique($user->image, 2);
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
                ->orWhere('u.phone_code', $value)
                ->orWhere('u.email', $value);
        }
    }
}
