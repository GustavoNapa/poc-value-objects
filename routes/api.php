<?php

use App\Models\Person;
use App\ValueObjects\Cpf;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/person', function () {
    $people = Person::get();
    
    foreach ($people as $key => $person) {
        $people[$key]->cpf = $person->documentNumber->get();
        $people[$key]->cpfMasked = $person->documentNumber->get_masked();
    }

    return $people;
});

Route::post('/person', function (Request $request) {
    // http_response_code(201);
    $person = Person::create([
        'documentNumber' => Cpf::fromString($request->documentNumber),
        'name' => $request->name,
        'motherName' => $request->motherName,
        'birthDate' => $request->birthDate,
        'email' => $request->email,
        'phoneNumber' => $request->phoneNumber,
        'password' => $request->password,
    ]);
    return response(["id" => $person->id], 201);
});