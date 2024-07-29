<?php declare(strict_types=1);

namespace App\Services;

use App\Model\Facade\UserAccountFacade;
use Nette;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class CustomAuthenticator implements Authenticator
{

    public function __construct(
        private UserAccountFacade $userAccountFacade,
    )
    {
    }

    //////////////////////////////////////////////////////// Authenticate

    public function authenticate(string $user, string $password): IIdentity
    {
        $userAccount = $this->userAccountFacade->findOneBy(['email' => $user]);

        if (!$userAccount) {
            throw new AuthenticationException('Špatný e-mail nebo heslo', self::IdentityNotFound);
        }

        return new SimpleIdentity($userAccount->getId(), [$userAccount->getEmail()]);
    }

}
