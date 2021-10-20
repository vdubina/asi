<?php

namespace App\Http\Controllers;

use F9Web\ApiResponseHelpers;

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
}
