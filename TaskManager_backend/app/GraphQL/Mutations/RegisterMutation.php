<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\AuthService;

final class RegisterMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = new AuthService;

        return $user->register($args);
    }
}
