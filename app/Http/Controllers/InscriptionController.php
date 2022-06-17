<?php
namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Utilisateur;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceived;
use App\PaymentGateway\Stripe;
use App\PaymentGateway\Paypal;


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
            'inscriptions' => Inscription::with(['utilisateur', 'pack'])
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
        $payment_gateway_url = "";

        $inscription = new Inscription;

        $inscription->pack_id = $validated['pack_id'] ?? null;
		$inscription->programme_ids = $validated['programme_ids'] ?? null;
		$inscription->utilisateur_id = $validated['utilisateur_id'] ?? null;
		$inscription->prix = $validated['prix'] ?? null;
		$inscription->mode_paiement = $validated['mode_paiement'] ?? null;
		$inscription->status_paiement = $validated['status_paiement'] ?? 'en-attente';
        $inscription->paiement_id = Str::random(60);    
		
        $inscription->save();

        try {
            $user = Utilisateur::findOrFail($inscription->utilisateur_id);

            // Mail::to($user->email)->queue(new OrderReceived($inscription));
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        try {
            $pack = $inscription->pack;
            
            switch (strtolower($inscription->mode_paiement)) {
                case 'stripe':
                    $payment_gateway_url = Stripe::getCheckoutUrl($pack->prix, $inscription->paiement_id);
                    break;
                case 'paypal':
                    $payment_gateway_url = Paypal::getCheckoutUrl($pack->prix, $inscription->paiement_id);
                    break;
                default:
                    break;
            }    
        } catch (\Throwable $th) {
            throw $th;
        }

        $data = [
            'success'       => true,
            'inscription'   => $inscription,
            'payment_gateway_url' => $payment_gateway_url
        ];
        
        return response()->json($data);
    }

    public function validatePayment(Request $request) {
        $payment_id = $request->input('payment_id');
        
        if (!$payment_id)
            throw new \Exception("Une erreur est survenue. Veuillez reéssayer", 1);

        $inscription = Inscription::where('paiement_id', $payment_id)->firstOrFail();
        $inscription->status_paiement = 'paye';
        $inscription->save();

        //Send tikcet

        $data = [
            "success" => true
        ];

        return response()->json($data, 200);
       
    }

    public function cancelPayment(Request $request) {
        $payment_id = $request->input('payment_id');

        if (!$payment_id)
            throw new \Exception("Une erreur est survenue. Veuillez reéssayer", 1);

        $inscription = Inscription::where('paiement_id', $payment_id)->firstOrFail();
        $inscription->status_paiement = 'annule';
        $inscription->save();

        //Send tikcet

        $data = [
            "success" => true
        ];

        return response()->json($data, 200);
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

    public function details(Request $request, string $payment_id) 
    {
        $inscription = Inscription::where('paiement_id', $payment_id)->firstOrFail();
        $programmes = Programme::whereIn('id', json_decode($inscription->programme_ids))->get();
        $inscription['programmes'] = $programmes;

        return view('inscription.details', ['inscription' => $inscription]);
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
		$inscription->programme_ids = $validated['programme_ids'] ?? null;
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