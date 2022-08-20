<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function loginprocess(Request $r)
    {
        $user = User::firstWhere("username", $r->username);
        if ($user) {
            $checkpassword = Hash::check($r->password, $user->password);
            if ($checkpassword) {
                $token = $user->createToken('token_name');
                return ['token' => $token->plainTextToken];

            }
        }
        return response()->json(['message' => 'These credential do not match with our records'], 404);
    }

public function getuser(Request $r){
    return response()->json($r->user());
}

}


