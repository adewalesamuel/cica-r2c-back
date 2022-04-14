<?php
namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use Illuminate\Support\Str;


class ResumeController extends Controller
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
            'resumes' => Resume::where('id', '>', -1)
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
    public function store(StoreResumeRequest $request)
    {
        $validated = $request->validated();

        $resume = new Resume;

        $resume->titre = $validated['titre'] ?? null;
		$resume->mots_cles = $validated['mots_cles'] ?? null;
		$resume->auteurs = $validated['auteurs'] ?? null;
		$resume->contenu = $validated['contenu'] ?? null;
		$resume->utilisateur_id = $validated['utilisateur_id'] ?? null;
		
        $resume->save();

        $data = [
            'success'       => true,
            'resume'   => $resume
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        $data = [
            'success' => true,
            'resume' => $resume
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResumeRequest $request, Resume $resume)
    {
        $validated = $request->validated();

        $resume->titre = $validated['titre'] ?? null;
		$resume->mots_cles = $validated['mots_cles'] ?? null;
		$resume->auteurs = $validated['auteurs'] ?? null;
		$resume->contenu = $validated['contenu'] ?? null;
		$resume->utilisateur_id = $validated['utilisateur_id'] ?? null;
		
        $resume->save();

        $data = [
            'success'       => true,
            'resume'   => $resume
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {   
        $resume->delete();

        $data = [
            'success' => true,
            'resume' => $resume
        ];

        return response()->json($data);
    }
}