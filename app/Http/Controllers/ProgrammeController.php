<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProgrammeRequest;
use App\Http\Requests\UpdateProgrammeRequest;

class ProgrammeController extends Controller
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
            "programmes" => Programme::where('id', '>', -1)
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
    public function store(StoreProgrammeRequest $request)
    {
        $validated = $request->validated();

        $programme = new Programme;

        $programme->titre = $validated['titre'];
        $programme->description = $validated['description'] ?? null;
        $programme->date = $validated['date'];
        $programme->heure = $validated['heure'];
        $programme->categorie_id = $validated['categorie_id'];

        $programme->save();

        $data = [
            'success'   => true,
            'programme' => $programme
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        $data = [
            'success' => true,
            'programme' => $programme
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgrammeRequest $request, Programme $programme)
    {
        $validated = $request->validated();

        $programme->titre = $validated['titre'];
        $programme->description = $validated['description'] ?? null;
        $programme->date = $validated['date'];
        $programme->heure = $validated['heure'];
        $programme->categorie_id = $validated['categorie_id'];

        $programme->save();

        $data = [
            'success'   => true,
            'programme' => $programme
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();

        $data = [
            'success' => true,
            'programme' => $programme
        ];

        return response()->json($data);
    }
}
