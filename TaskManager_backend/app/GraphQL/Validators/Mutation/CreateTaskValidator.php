<?php

declare(strict_types=1);

namespace App\GraphQL\Validators\Mutation;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;

final class CreateTaskValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', Rule::unique('tasks', 'title'),],
            'description' => ['required', 'string', 'min:3'],
            'due_date' => ['required', 'date'],
            'category_id' => ['required', 'numeric', 'exists:task_categories,id'],
        ];
    }
}
