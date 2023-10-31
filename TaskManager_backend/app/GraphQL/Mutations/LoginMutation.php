<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\AuthService;
use Illuminate\Support\Arr;


final class LoginMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = new AuthService;

        $credentials = Arr::only($args, ['email', 'password']);

        return $user->login($credentials);
    }
}
