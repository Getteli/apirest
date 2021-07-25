<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// rota de teste, assim vc pode fazer:
// no navagedor digite o endereço e entao digite: /api/teste
Route::get('/teste', function()
{
    return 'olá mundo';
});


// em vez de uma funcao no segundo parametro, chamamos o controller q queremos, entre aspas
// e veja q usamos um @ depois do nome do controller, e entao botamos o nome do metodo q iremos usar no controller
// e pronto, o retorno ele faz direto de lá
Route::get('/students', 'StudentController@index')->name('students.index');

Route::get('/students/{student}', 'StudentController@show')->name('students.show');

Route::post('/students', 'StudentController@store')->name('students.store');

Route::put('/students/{student}', 'StudentController@update')->name('students.update');

Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');

//
Route::apiResource('classroom', 'ClassroomController');