<?php

namespace App\Http\Controllers\Modules\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * change password user
     * POST /auth/change-password
     */
    public function changePassword(Request $request)
    {
        /** validate */
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = Auth::user();
        if(!Hash::check($request->old_password, $user->password)){
            return $this->responseJson(false, '<em class="fa fa-minus-circle"> La contraseña actual es incorrecta',  $user);
        }

        $userManager = User::find($user->id)->first();
        $userManager->password = Hash::make($request->password);
        $userManager->save();

        return $this->responseJson(true, 'El password se actualizo con exito',  $user);
    }
}
