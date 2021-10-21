<?php

namespace App\Http\Controllers\Api;

use F9Web\ApiResponseHelpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Api Documentation",
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Main Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     description="Use /auth/login endpoint to obtain a token",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 *
 * @OA\OpenApi(
 *   security={
 *     {
 *       "bearerAuth": {"read:bearerAuth"},
 *     }
 *   }
 * )
 *
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
class ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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
