<?php declare(strict_types=1);

namespace App\Model\Service;

use Nettrine\ORM\EntityManagerDecorator;

final class UserAccountService extends BaseService
{

    public function __construct(
        EntityManagerDecorator $em,
    )
    {
        parent::__construct($em);
    }

}
