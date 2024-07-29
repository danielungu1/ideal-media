<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\RoomReservation;
use Nettrine\ORM\EntityManagerDecorator;

final class RoomReservationFacade extends BaseFacade
{

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct($em, RoomReservation::class);
    }

}
