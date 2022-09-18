<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function userLogin(Request $request) : array
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token'=> $user->createToken('user')->plainTextToken, 'user' => $user];
    }

    public function adminLogin(Request $request): array
    {
        $user = AdminUser::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token'=> $user->createToken('admin')->plainTextToken, 'user' => $user];
    }
     public function userRegister(Request $request): array
     {
         try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if ($user) {
               return ['token'=>$user->createToken('user')->plainTextToken, 'user' => $user];
            }
         } catch (\Throwable $th) {
             throw $th;
         }
     }
}
