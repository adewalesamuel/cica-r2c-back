<?php
namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;
use App\Http\Requests\StorePackRequest;
use App\Http\Requests\UpdatePackRequest;
use Illuminate\Support\Str;


class PackController extends Controller
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
            'packs' => Pack::where('id', '>', -1)
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
    public function store(StorePackRequest $request)
    {
        $validated = $request->validated();

        $pack = new Pack;

        $pack->qualification = $validated['qualification'] ?? null;
		$pack->prix = $validated['prix'] ?? null;
		$pack->regle_prix = $validated['regle_prix'] ?? null;
		
        $pack->save();

        $data = [
            'success'       => true,
            'pack'   => $pack
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function show(Pack $pack)
    {
        $data = [
            'success' => true,
            'pack' => $pack
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function edit(Pack $pack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackRequest $request, Pack $pack)
    {
        $validated = $request->validated();

        $pack->qualification = $validated['qualification'] ?? null;
		$pack->prix = $validated['prix'] ?? null;
		$pack->regle_prix = $validated['regle_prix'] ?? null;
		
        $pack->save();

        $data = [
            'success'       => true,
            'pack'   => $pack
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pack $pack)
    {   
        $pack->delete();

        $data = [
            'success' => true,
            'pack' => $pack
        ];

        return response()->json($data);
    }
}