<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e): \Illuminate\Http\Response|JsonResponse|RedirectResponse|Response
    {
        if ($e instanceof NotFoundHttpException) {
            return response()->json(['message' => 'Endpoint not found.'], 404);
        }

        if ($e instanceof ValidationException) {
            $errors = [];
            foreach ($e->validator->errors()->getMessages() as $errorMessages){
                $errors[] = $errorMessages[0];
            }
            return response()->json(['errors' => $errors], 400);
        }

        return parent::render($request, $e);
    }
}
