<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      type="object",
 *      required={"refresh_token"}
 * )
 */
class AuthRefreshRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="refresh_token",
     *      description="Refresh Token (min 6, max 2048)",
     *      example="EXAMPLETOKEN"
     * )
     *
     * @var string
     */
    public $refresh_token;

    /**
     * Validation Rules
     */
    public function rules()
    {
        return [
            'refresh_token' => [
                'string',
                'required',
                'min:6',
                'max:2048',
            ],
        ];
    }
}
