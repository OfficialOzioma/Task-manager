<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Services\TaskServices;

final class SearchTask
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $task = new TaskServices();

        $task->search($args);
    }
}