<?php declare(strict_types=1);

namespace App\Services;

use Nette;
use Nette\Security\AuthenticationException;
use Nette\Security\UserStorage;

class User extends Nette\Security\User
{

    public function __construct(
        CustomAuthenticator $customAuthenticator,
        UserStorage $storage,
    )
    {
        parent::__construct(
            storage: $storage,
            authenticator: $customAuthenticator
        );
    }

    public function login($user, string $password = null): void
    {
        try {
            parent::login($user, $password);
        } catch (\Exception $e) {
            throw new AuthenticationException($e->getMessage());
        }
    }


}
