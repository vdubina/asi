<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
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
     * User Login
     *
     * @param AuthLoginRequest $request
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
     * User Logout
     *
     * @param AuthLoginRequest $request
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update(['revoked' => true]);

        $token->revoke();
        return $this->respondWithSuccess();
    }

    /**
     * Refresh Access Token
     *
     * @param AuthLoginRequest $request
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

}
