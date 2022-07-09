<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::any('ticket', function(Request $request) {
    $inscription = App\Models\Inscription::first();
    $programmes = App\Models\Programme::whereIn('id', json_decode($inscription->programme_ids))->get();
    $inscription['programmes'] = $programmes;

    $random_string = Illuminate\Support\Str::random(10);
    $path = storage_path(("{$random_string}.pdf"));
    
    $data = ['inscription' => $inscription];

    $pdf = PDF::loadView('ticket', $data)->setPaper('a4', 'landscape')->save($path); 

    Illuminate\Support\Facades\Mail::to('samroberval@gmail.com')->queue(new App\Mail\PaymentSuccess($inscription, $path));

    return view('ticket', $data);
});

Route::get('inscriptions/{payment_id}/details', [InscriptionController::class, 'details']);

Route::get('/front{any}', function () {
    return view('front');
})->where('any', '.*');

Route::get('/{any1}', function () {
    return view('back');
})->where('any1', '.*');