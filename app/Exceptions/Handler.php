<?php

namespace App\Exceptions;

use Throwable;
use App\Enums\StatusAPI;
use App\Http\Resources\Main\MainResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Old Register the exception handling callbacks for the application.
     */
    // public function register(): void
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }
    /**
     * spatie exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            return new MainResource(StatusAPI::ERROR, 403, 'You do not have the required authorization.',[]);
            // return response()->json([
            //     'responseMessage' => 'You do not have the required authorization.',
            //     'responseStatus'  => 403,
            // ]);
        });
    }
}
