<?php declare(strict_types=1);

namespace App\Facade;

use App\Model\UserAccount;
use Nettrine\ORM\EntityManagerDecorator;

final class UserAccountFacade extends BaseFacade
{

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct($em, UserAccount::class);
    }

    //////////////////////////////////////////////////////// Public

    public function isEmailFreeToAssign(UserAccount $user, string $email): bool
    {
        if ($user->getId() && $user->getEmail() === $email) {
            return true;
        }

        return !$this->findOneBy(['email' => $email]);
    }

}
