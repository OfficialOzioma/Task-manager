<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdateTaskValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'unique_id' => ['required', 'string'],
            'title' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'due_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string'],
            'category_id' => ['sometimes', 'numeric', 'exists:task_categories,id'],
        ];
    }
}
