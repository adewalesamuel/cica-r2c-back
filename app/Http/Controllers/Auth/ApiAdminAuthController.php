<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiAdminAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "mot_de_passe");
    
        if (!Auth::guard('admin')->once($credentials)) {
            $data = [
                'success' => false,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $administrateur = Administrateur::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "data" => $administrateur
        ];

        return response()->json($data);

    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $administrateur = Administrateur::where('api_token', $token)->first();

        if (!$administrateur) {
            $data = [
                "success" => false,
                "message" => "Une erreure est survenue"
            ];

            return response()->json($data, 500);
        }

        $administrateur->api_token = Str::random(60);

        $administrateur->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

    
}
