<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUtilisateurRequest;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");
    
        if (!Auth::once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect",
            ];

            return response()->json($data, 404);
        }

        $utilisateur = Utilisateur::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "utilisateur"    => $utilisateur
        ];

        return response()->json($data);

    }

    public function register(StoreUtilisateurRequest $request) {
        $validated = $request->validated();
        
        $utilisateur = new Utilisateur;

        $utilisateur->nom = $validated['nom'];
        $utilisateur->prenom = $validated['prenom'];
        $utilisateur->email = $validated['email'];
        $utilisateur->password = $validated['password'];
        $utilisateur->civilite = $validated['civilite'] ?? null;
        $utilisateur->fonction = $validated['fonction'];
        $utilisateur->specialite = $validated['specialite'];
        $utilisateur->profession = $validated['profession'];
        $utilisateur->societe = $validated['societe'];
        $utilisateur->service = $validated['service'];
        $utilisateur->adresse = $validated['adresse'] ?? null;
        $utilisateur->code_postal = $validated['code_postal'];
        $utilisateur->ville = $validated['ville'];
        $utilisateur->pays = $validated['pays'];
        $utilisateur->telephone = $validated['telephone'];
        $utilisateur->fax = $validated['fax'] ?? null;
        $utilisateur->autres = $validated['autres'] ?? null;
        $utilisateur->has_accepted_conditions = $validated['has_accepted_conditions'] ?? null;
        $utilisateur->is_r2c_member = $validated['is_r2c_member'] ?? null;
        $utilisateur->api_token = Str::random(60);

        $utilisateur->save();

        $data = [
            'success'       => true,
            'utilisateur'   => $utilisateur
        ];
        
        return response()->json($data);
    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $utilisateur = Utilisateur::where('api_token', $token)->first();

        if (!$utilisateur) {
            $data = [
                "success" => false,
                "message" => "Une erreur est survenue"
            ];

            return response()->json($data, 500);
        }

        $utilisateur->api_token = Str::random(60);

        $utilisateur->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

    
}
