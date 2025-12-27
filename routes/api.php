<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TypeChambreController;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('send-mail', function () {
    Mail::to('sergetelolahy3@gmail.com')->send(new TestMail());
    return 'Mail envoyé sans vue !';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('', 'auth')->middleware('auth:sanctum');
    Route::post('/login', 'login');
    Route::post('/register/client', 'registerClient');
    Route::post('/register/personnel', 'registerPersonnel');
});

Route::prefix('equipements')->controller(EquipementController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('types-chambre')->controller(TypeChambreController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('chambres')->controller(ChambreController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show')->where('id', '[0-9]+');
    Route::get('/disponibles', 'disponibles');
    Route::get('/occupees', 'occupees');
    Route::post('/', 'store');
    Route::post('/{id}/images', 'addImage');
    Route::put('/{id}', 'update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'destroy')->where('id', '[0-9]+');
    Route::get('/{id}/maintenances', 'maintenances')->where('id', '[0-9]+');
});

Route::prefix('images')->controller(ImageController::class)->group(function () {
    Route::post('/', 'store');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('clients')->controller(ClientController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    // Route::post('/', 'store');
    Route::put('/', 'update')->middleware('auth:sanctum');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('personnels')->controller(PersonnelController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('reservations')->controller(ReservationController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/me', 'indexByAuth')->middleware('auth:sanctum');
    Route::get('/{id}', 'show')->where('id', '[0-9]+');
    Route::get('/{id}/me', 'showByAuth')->where('id', '[0-9]+')->middleware('auth:sanctum');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::put('/{id}', 'update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'destroy')->where('id', '[0-9]+');
    Route::post('/{id}/paiements', 'storePaiement')->where('id', '[0-9]+');
    Route::put('/{id}/check-in', 'checkIn')->where('id', '[0-9]+');
    Route::put('/{id}/check-out', 'checkOut')->where('id', '[0-9]+');
});

Route::prefix('maintenances')->controller(MaintenanceController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show')->where('id', '[0-9]+');
    Route::post('/', 'store');
    Route::put('/{id}', 'update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'destroy')->where('id', '[0-9]+');
    Route::put('/{id}/fin', 'fin')->where('id', '[0-9]+');
});
