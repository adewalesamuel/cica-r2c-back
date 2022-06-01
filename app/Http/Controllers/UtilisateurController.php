<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;
use Illuminate\Support\Str;


class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "success" => true,
            "utilisateurs" => Utilisateur::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    public function resumes(Request $request, Utilisateur $utilisateur) {
        $data = [
            'success' => true,
            'resumes' => $utilisateur->resumes->sortByDesc('created_at')
            ->values()->all()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function show(Utilisateur $utilisateur)
    {
        $data = [
            'success' => true,
            'utilisateur' => $utilisateur
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUtilisateurRequest $request, Utilisateur $utilisateur)
    {
        $validated = $request->validated();

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

        $utilisateur->save();

        $data = [
            'success'       => true,
            'utilisateur'   => $utilisateur
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utilisateur $utilisateur)
    {   
        $utilisateur->delete();

        $data = [
            'success' => true,
            'utilisateur' => $utilisateur
        ];

        return response()->json($data);
    }
}
