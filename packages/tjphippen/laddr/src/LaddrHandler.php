<?php declare(strict_types=1);

namespace Tjphippen\Laddr\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class LaddrHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Throwable $exception
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
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if(method_exists($e, 'getModel')) {
            $model = str_replace('App\\Models\\', '', $e->getModel());
            $id = $request->route()[2]['id'];
        }
        if ($e instanceof ValidationException) {
            $errors = [];
            foreach($e->errors() as $field => $error) {
                $errors[] = [
                    'source' => ['pointer' => '/data/attributes/' . $field],
                    'status' => $e->status,
                    'detail' => current($error)
                ];
            }
            return response()->json(['errors' => $errors], $e->status);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => [
                'status' => 404,
                'code' => $e->getCode(),
                'detail' => 'Entry for ' . $model . ' ' . $id . ' not found'
            ]], 404);
        }
        return parent::render($request, $e);
    }
}
