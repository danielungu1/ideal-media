<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\RoomAvailability;
use Nettrine\ORM\EntityManagerDecorator;

final class RoomAvailabilityFacade extends BaseFacade
{

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct($em, RoomAvailability::class);
    }

}
