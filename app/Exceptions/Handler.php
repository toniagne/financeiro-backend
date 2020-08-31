<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);

        // TRATAMENTO DOS ERROS DO PASSPORT
        if (get_class($exception) == OAuthServerException::class) {
            if ($exception->statusCode() == 400){
                return response()->json(false, 200);
            }

        }

        // METODO PARA RETORNO DOS ERROS DA REQUEST
        if ($request->is("api/*")){

            // TRATAMENTO DOS ERROS QUANDO ACESSA DIRETAMENTO A API
            if(!empty(trim($request->input('api_token')))) {
                if ($exception instanceof ValidationException) {
                    return response()->json(
                        $exception->errors(),
                        $exception->status
                    );
                }
            } else {
                return response()->json(['data' => $exception->errors(), 'status' => $exception->status], 200);
            }
        }

        return parent::render($request, $exception);



    }
    protected function unauthenticated($request, AuthenticationException $exception) {

        if($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('home'));

    }
}
