<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      type="object",
 *      required={"username","password"}
 * )
 */
class AuthLoginRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="username",
     *      description="Username (email, min 6, max 60)",
     *      example="user@user.com"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="password",
     *      description="User Password (min 8, max 60)",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * Validation Rules
     */
    public function rules()
    {
        return [
            'username' => [
                'string',
                'email',
                'required',
                'min:6',
                'max:60',
            ],
            'password' => [
                'string',
                'required',
                'min:8',
                'max:60',
            ],
        ];
    }
}
