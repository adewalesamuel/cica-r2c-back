<?php
namespace App\Http\Controllers;

use App\Models\Telechargement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTelechargementRequest;
use App\Http\Requests\UpdateTelechargementRequest;
use Illuminate\Support\Str;


class TelechargementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'success' => true,
            'telechargements' => Telechargement::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
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
    public function store(StoreTelechargementRequest $request)
    {
        $validated = $request->validated();

        $telechargement = new Telechargement;

        $telechargement->nom = $validated['nom'] ?? null;
		$telechargement->description = $validated['description'] ?? null;

        if ($request->hasFile('fichier'))
            $telechargement->url_fichier = str_replace('public', 'storage', $request->fichier->store('public'));
            
        $telechargement->save();

        $data = [
            'success'       => true,
            'telechargement'   => $telechargement
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function show(Telechargement $telechargement)
    {
        $data = [
            'success' => true,
            'telechargement' => $telechargement
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function edit(Telechargement $telechargement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTelechargementRequest $request, Telechargement $telechargement)
    {
        $validated = $request->validated();

        $telechargement->nom = $validated['nom'] ?? null;
		$telechargement->description = $validated['description'] ?? null;

        if ($request->hasFile('fichier')) 
            $telechargement->url_fichier = str_replace('public', 'storage', $request->fichier->store('public'));
            
        $telechargement->save();

        $data = [
            'success'       => true,
            'telechargement'   => $telechargement
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telechargement $telechargement)
    {   
        $telechargement->delete();

        $data = [
            'success' => true,
            'telechargement' => $telechargement
        ];

        return response()->json($data);
    }
}