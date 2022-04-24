<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users\UserProfile;
use Illuminate\Database\Seeder;

class UserAdminitratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'uuid' => 'gerardo-root',
            'status' => true,
            'term_accepted_id' => 1,
            'gender_id' => 1,
            'first_name' => "Gerardo",
            'last_name' => "Carvajal",
            'phone_code' => "57",
            'phone_number' => "3133545798",
            'has_password' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        UserProfile::create([
            'user_id' => 1,
            'email' => "gerardocarvajalvargas@gmail.com",
            'validated' => true,
            'notifications_sms' => true,
            'notifications_push' => true,
            'notifications_email' => true,
        ]);
    }
}
