<?php

namespace App\Exceptions\Traits;

// temos que instanciar a classe q o exception retorna, para verificarmos no instanceof
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
// para pegar o enumeration dos tipos de exceptions de http
use Illuminate\Http\Response;

trait ApiException
{
	// metodo que vai pegar o exception em json, recebe o request se tiver e o erro
	protected function getJsonException($request, $e)
	{
		// return dd($e);
		// quando o registro nao foi encontrado, o laravel retorna um erro instanciado numa classe chamada NotFoundHttpException
		// entao verificamos se o exception é uma instancia dessa classe, e retornamos o erro manual que criamos, fazendo todos os erros centralizados aqui (desse tipo)
		if ($e instanceof NotFoundHttpException) {
	        // video 19
	        return $this->notFoundException();
		}
		elseif ($e instanceof ValidationException)
		{
			return $this->validationException($e);
		}
		elseif ($e instanceof ThrottleRequestsException)
		{
			return "limite de tempo, fazer um retorno em json e etc";
		}
		else if($e instanceof HttpException)
		{
			return $this->httpException($e);
		}

		return $this->genericException();
	}

	protected function notFoundException()
	{
		return $this->getResponse(
			"registro não encontrado :(",
			"01",
			404
		);
	}

	protected function genericException()
	{
		return $this->getResponse(
			"Error interno no servidor",
			"02",
			500
		);
	}

	protected function validationException($e)
	{
		return response()->json($e->errors(), $e->status);
	}

	protected function httpException($e)
	{
		return $this->getResponse(
			"Erro de metodo. Não permitido para esse endpoint",
			"03",
			$e->getStatusCode()
		);
	}

	protected function getResponse($message, $code, $status)
	{
        // exemplo de retorno de erro diretamente, de forma manual, video 17
        return response()->json([
            "errors" => [
                [
                    "status" => $status, // o codigo de retorno padrao do http da internet
                    "code" => $code, // codigo interno da nossa api onde documentaremos os tipos de erros e dando codigos
                    "message" => $message // mensagem explicando o erro, deixando legivel para humanos
                ]
            ]
        ], Response::HTTP_NOT_FOUND);
	}
}