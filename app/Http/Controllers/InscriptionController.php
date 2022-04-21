<?php
namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use Illuminate\Support\Str;


class InscriptionController extends Controller
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
            'inscriptions' => Inscription::with(['utilisateur', 'programme', 'pack'])
            ->where('id', '>', -1)->orderBy('created_at', 'desc')->get()
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
    public function store(StoreInscriptionRequest $request)
    {
        $validated = $request->validated();

        $inscription = new Inscription;

        $inscription->pack_id = $validated['pack_id'] ?? null;
		$inscription->programme_id = $validated['programme_id'] ?? null;
		$inscription->utilisateur_id = $validated['utilisateur_id'] ?? null;
		$inscription->prix = $validated['prix'] ?? null;
		$inscription->mode_paiement = $validated['mode_paiement'] ?? null;
		$inscription->status_paiement = $validated['status_paiement'] ?? 'en-attente';
		
        $inscription->save();

        $data = [
            'success'       => true,
            'inscription'   => $inscription
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function show(Inscription $inscription)
    {
        $data = [
            'success' => true,
            'inscription' => $inscription
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInscriptionRequest $request, Inscription $inscription)
    {
        $validated = $request->validated();

        $inscription->pack_id = $validated['pack_id'] ?? null;
		$inscription->programme_id = $validated['programme_id'] ?? null;
		$inscription->utilisateur_id = $validated['utilisateur_id'] ?? null;
		$inscription->prix = $validated['prix'] ?? null;
		$inscription->mode_paiement = $validated['mode_paiement'] ?? null;
		$inscription->status_paiement = $validated['status_paiement'] ?? 'en-attente';
		
        $inscription->save();

        $data = [
            'success'       => true,
            'inscription'   => $inscription
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscription $inscription)
    {   
        $inscription->delete();

        $data = [
            'success' => true,
            'inscription' => $inscription
        ];

        return response()->json($data);
    }
}