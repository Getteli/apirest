<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// fazemos o uso o trait criado
use App\Exceptions\Traits\ApiException;
use Throwable;

class Handler extends ExceptionHandler
{
    // e entao chame o use no trait dentro da classe, fora da erro
    use ApiException;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // metodo padrao q ja aparece no laravel
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        // as exceçoes padrao do laravel cai aqui, esse metodo nao existia, eu q fiz, no laravel antigo tinha o metodo render, agora no 8 nao tem, tem o renderable. e botei o request
        // o erro cai aqui de forma nativa,
        $this->renderable(function (Throwable $e, $request) {
            // poderia chamar aqui direto o erro, porem vamos criar um traid (tipo uma classe) onde poderemos criar os metodos todos q farao o tratamento de erro por cada tipo de erro q o eloquent tenha
            // neste caso fizemos apenas o de nao encontrado
            if ($request->is("api/*")) {
                return $this->getJsonException($request, $e);
            }
        });
    }
}
