<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AuthLoginRequest;
use App\Http\Requests\Api\AuthRefreshRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 * API User Authentication Controller
 */
class AuthController extends ApiController
{
    public $scope = "frontend profile";

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="authLogin",
     *      tags={"Auth"},
     *      summary="Login user with password",
     *      description="Validates user password and returns OAuth2 tokens",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="The user credentials were incorrect"
     *      ),
     * )
     */
    public function login(AuthLoginRequest $request)
    {
        $response = Http::asJson()->post(env('PASSPORT_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT'),
            'client_secret' => env('PASSPORT_SECRET'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'scope' => $this->scope,
        ]);
        return response($response->json(), $response->getStatusCode());
    }

    /**
     * @OA\Post(
     *      path="/auth/refresh",
     *      operationId="authRefresh",
     *      tags={"Auth"},
     *      summary="Refresh access token",
     *      description="Refreshes access token by provided refresh token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthRefreshRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="The refresh token is invalid"
     *      ),
     * )
     */
    public function refresh(AuthRefreshRequest $request)
    {
        $response = Http::asJson()->post(env('PASSPORT_URL') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => env('PASSPORT_CLIENT'),
            'client_secret' => env('PASSPORT_SECRET'),
            'refresh_token' => $request->input('refresh_token'),
            'scope' => $this->scope,
        ]);
        return response($response->json(), $response->getStatusCode());
    }

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      security={{"bearerAuth": {}}},
     *      operationId="authLogout",
     *      tags={"Auth"},
     *      summary="Logout user & revoke tokens",
     *      description="Revokes user access and refresh tokens",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     * )
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        if (isset($token->id)) {
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $token->id)
                ->update(['revoked' => true]);
            $token->revoke();
            return $this->respondWithSuccess();
        } else {
            return $this->respondUnAuthenticated();
        }
    }


}
