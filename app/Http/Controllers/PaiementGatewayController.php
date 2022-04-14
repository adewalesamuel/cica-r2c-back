<?php
namespace App\Http\Controllers;

use App\Models\PaiementGateway;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaiementGatewayRequest;
use App\Http\Requests\UpdatePaiementGatewayRequest;
use Illuminate\Support\Str;


class PaiementGatewayController extends Controller
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
            'paiement_gateways' => PaiementGateway::where('id', '>', -1)
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
    public function store(StorePaiementGatewayRequest $request)
    {
        $validated = $request->validated();

        $paiementgateway = new PaiementGateway;

        $paiementgateway->nom = $validated['nom'] ?? null;
		$paiementgateway->infos_connexion = $validated['infos_connexion'] ?? null;
		
        $paiementgateway->save();

        $data = [
            'success'       => true,
            'paiement_gateway'   => $paiementgateway
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaiementGateway  $paiementgateway
     * @return \Illuminate\Http\Response
     */
    public function show(PaiementGateway $paiementgateway)
    {
        $data = [
            'success' => true,
            'paiement_gateway' => $paiementgateway
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaiementGateway  $paiementgateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaiementGateway $paiementgateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaiementGateway  $paiementgateway
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaiementGatewayRequest $request, PaiementGateway $paiementgateway)
    {
        $validated = $request->validated();

        $paiementgateway->nom = $validated['nom'] ?? null;
		$paiementgateway->infos_connexion = $validated['infos_connexion'] ?? null;
		
        $paiementgateway->save();

        $data = [
            'success'       => true,
            'paiement_gateway'   => $paiementgateway
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaiementGateway  $paiementgateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaiementGateway $paiementgateway)
    {   
        $paiementgateway->delete();

        $data = [
            'success' => true,
            'paiement_gateway' => $paiementgateway
        ];

        return response()->json($data);
    }
}