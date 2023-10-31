<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\TaskServices;

final class UpdateTaskMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $task = new TaskServices;

        return $task->updateTask($args);
    }
}
