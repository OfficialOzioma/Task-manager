<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;

final class RegisterValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],

            'email' => [
                'required',
                Rule::unique('users', 'email'),
            ],

            'password' => ['required', 'min:8']
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'The chosen username is not available',
        ];
    }
}
