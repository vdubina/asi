<?php

namespace App\Http\Controllers;

use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Available Response Helpers:
 * respondNotFound(string|Exception $message, ?string $key = 'error')
 * respondWithSuccess(array|Arrayable|JsonSerializable|null $contents = null)
 * respondOk(string $message)
 * respondUnAuthenticated(?string $message = null)
 * respondForbidden(?string $message = null)
 * respondError(?string $message = null)
 * respondCreated(array|Arrayable|JsonSerializable|null $data = null)
 * respondNoContent(array|Arrayable|JsonSerializable|null $data = null)
 */
class ApiController extends Controller
{
    use ApiResponseHelpers;

    /**
     * @param $permission
     */
    public function checkGate($permission)
    {
        abort_if(
            Gate::forUser(request()->user())->denies($permission), Response::HTTP_FORBIDDEN, '403 Forbidden'
        );
    }
}
