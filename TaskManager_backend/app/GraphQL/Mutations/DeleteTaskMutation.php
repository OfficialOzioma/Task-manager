<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\TaskServices;

final class DeleteTaskMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $task = new TaskServices;

        return $task->deleteTask($args);
    }
}
