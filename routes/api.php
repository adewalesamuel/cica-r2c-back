<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\ApiAdminAuthController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PaiementGatewayController;
use App\Http\Controllers\TelechargementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/admin-login', [ApiAdminAuthController::class, 'login']);
Route::post('/admin-logout', [ApiAdminAuthController::class, 'logout']);

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout']);

Route::post('utilisateurs', [ApiAuthController::class, 'register']);

Route::get('categories', [CategorieController::class, 'index']);
Route::get('programmes', [ProgrammeController::class, 'index']);
Route::get('packs', [PackController::class, 'index']);
Route::get('paiementgateways', [PaiementGatewayController::class, 'index']);

Route::any('inscriptions/success', [InscriptionController::class, 'validatePayment']);
Route::any('inscriptions/cancel', [InscriptionController::class, 'cancelPayment']);
Route::post('inscriptions', [InscriptionController::class, 'store']);

Route::get('telechargements', [TelechargementController::class, 'index']);

Route::any('test-mail', function(Request $request) {
    $inscription = App\Models\Inscription::first();
    $programmes = App\Models\Programme::whereIn('id', json_decode($inscription->programme_ids))->get();
    $inscription['programmes'] = $programmes;

    $data = [
        "inscription" => $inscription    
    ];

    Illuminate\Support\Facades\Mail::to("samroberval@yahoo.fr")->queue(new App\Mail\OrderReceived($inscription));

    return view('emails.orders.received', $data);
 });

 Route::any('test-stripe', function(Request $request) {
    echo App\PaymentGateway\Stripe::getCheckoutUrl(2055);
    // return response()->json($res, 200);
 });

 Route::any('env-test', function() {
    return response()->json(['env' => env('PAYMENT_URL')], 200);
 });

Route::prefix('utilisateurs')->group(function() {
    Route::middleware('auth.api')->group(function () {
        Route::get('{utilisateur}/resumes', [UtilisateurController::class, 'resumes']);
        Route::get('{utilisateur}/profile', [UtilisateurController::class, 'show']);
        Route::put('{utilisateur}/profile', [UtilisateurController::class, 'update']);
        Route::get('{utilisateur}/inscriptions', [UtilisateurController::class, 'inscriptions']);
        
        Route::post('resumes', [ResumeController::class, 'store']);
        Route::get('resumes/{resume}', [ResumeController::class, 'show']);
        Route::post('resumes/{resume}', [ResumeController::class, 'update']);
        Route::delete('resumes/{resume}', [ResumeController::class, 'destroy']);

        Route::get('inscriptions/{inscription}', [InscriptionController::class, 'show']);

    });
});

Route::middleware('auth.api:admin')->group(function () {
    
    Route::get('utilisateurs', [UtilisateurController::class, 'index']);
    Route::get('utilisateurs/{utilisateur}', [UtilisateurController::class, 'show']);
    Route::put('utilisateurs/{utilisateur}', [UtilisateurController::class, 'update']);
    Route::delete('utilisateurs/{utilisateur}', [UtilisateurController::class, 'destroy']);
    
    Route::post('categories', [CategorieController::class, 'store']);
    Route::get('categories/{categorie}', [CategorieController::class, 'show']);
    Route::put('categories/{categorie}', [CategorieController::class, 'update']);
    Route::delete('categories/{categorie}', [CategorieController::class, 'destroy']);
    
    Route::get('administrateurs', [AdministrateurController::class, 'index']);
    Route::post('administrateurs', [AdministrateurController::class, 'store']);
    Route::get('administrateurs/{administrateur}', [AdministrateurController::class, 'show']);
    Route::put('administrateurs/{administrateur}', [AdministrateurController::class, 'update']);
    Route::delete('administrateurs/{administrateur}', [AdministrateurController::class, 'destroy']);
    
    Route::get('resumes', [ResumeController::class, 'index']);
    Route::post('resumes', [ResumeController::class, 'store']);
    Route::get('resumes/{resume}', [ResumeController::class, 'show']);
    Route::post('resumes/{resume}', [ResumeController::class, 'update']);
    Route::delete('resumes/{resume}', [ResumeController::class, 'destroy']);
    
    Route::post('programmes', [ProgrammeController::class, 'store']);
    Route::get('programmes/{programme}', [ProgrammeController::class, 'show']);
    Route::put('programmes/{programme}', [ProgrammeController::class, 'update']);
    Route::delete('programmes/{programme}', [ProgrammeController::class, 'destroy']);
    
    Route::post('packs', [PackController::class, 'store']);
    Route::get('packs/{pack}', [PackController::class, 'show']);
    Route::put('packs/{pack}', [PackController::class, 'update']);
    Route::delete('packs/{pack}', [PackController::class, 'destroy']);
    
    Route::get('inscriptions', [InscriptionController::class, 'index']);
    Route::get('inscriptions/{inscription}', [InscriptionController::class, 'show']);
    Route::put('inscriptions/{inscription}', [InscriptionController::class, 'update']);
    Route::delete('inscriptions/{inscription}', [InscriptionController::class, 'destroy']);
    
    Route::post('paiementgateways', [PaiementGatewayController::class, 'store']);
    Route::get('paiementgateways/{paiementgateway}', [PaiementGatewayController::class, 'show']);
    Route::put('paiementgateways/{paiementgateway}', [PaiementGatewayController::class, 'update']);
    Route::delete('paiementgateways/{paiementgateway}', [PaiementGatewayController::class, 'destroy']);
    
    // Route::get('telechargements', [TelechargementController::class, 'index']);
    Route::post('telechargements', [TelechargementController::class, 'store']);
    Route::get('telechargements/{telechargement}', [TelechargementController::class, 'show']);
    Route::post('telechargements/{telechargement}', [TelechargementController::class, 'update']);
    Route::delete('telechargements/{telechargement}', [TelechargementController::class, 'destroy']);
});

