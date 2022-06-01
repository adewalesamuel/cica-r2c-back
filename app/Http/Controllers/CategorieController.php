<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::where('id', '>', -1)->with('programmes')
        ->orderBy('created_at', 'desc')->get();
        $inscriptions = Inscription::all();
        $programme_ids = collect($inscriptions)->map(function($inscription) {
            return json_decode($inscription->programme_ids);
        });
        $programme_ids = array_merge(...$programme_ids);

        for ($i=0; $i < count($categories); $i++) {
            $categorie = $categories[$i];
            $categorie_programmes = $categorie->programmes;

            if ($categorie_programmes) {
                for ($j=0; $j < count($categorie_programmes); $j++) {
                    $programme = $categorie_programmes[$j];

                    for ($k=0; $k < count($programme_ids); $k++) {
                        $programme_id = $programme_ids[$k];  

                        if ($programme->id == $programme_id) {
                            if (!$programme['nbr_place_inscrit']) {
                                $categories[$i]['programmes'][$j]['nbr_place_inscrit'] = 1;
                            }else {
                                $categories[$i]['programmes'][$j]['nbr_place_inscrit'] += 1;
                            }
                        };
                    };
                };
            };
        }

        $data = [
            "success" => true,
            "categories" => $categories,
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
    public function store(StoreCategorieRequest $request)
    {   
        $validated = $request->validated();

        $categorie = new Categorie;

        $categorie->nom = $validated['nom'];
        $categorie->couleur = $validated['couleur'] ?? null;

        $categorie->save();

        $data = [
            'success'   => true,
            'categorie' => $categorie
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        $data = [
            'success' => true,
            'categorie' => $categorie
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $validated = $request->validated();

        $categorie->nom = $validated['nom'];
        $categorie->couleur = $validated['couleur'] ?? null;

        $categorie->save();

        $data = [
            'success'   => true,
            'categorie' => $categorie
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        $data = [
            'success' => true,
            'categorie' => $categorie
        ];

        return response()->json($data);
    }
}
