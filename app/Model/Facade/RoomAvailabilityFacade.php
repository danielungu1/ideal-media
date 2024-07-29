<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Room;
use App\Model\RoomAvailability;
use Nettrine\ORM\EntityManagerDecorator;

final class RoomAvailabilityFacade extends BaseFacade
{

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct($em, RoomAvailability::class);
    }

    public function findAvailableTimesByRoom(Room $room)
    {
        return $this->getQueryBuilder()
            ->leftJoin('e.roomReservations', 'rr')
            ->andWhere('rr.id IS NULL')
            ->andWhere('e.room = :room')
            ->setParameter('room', $room)
            ->getQuery()
            ->getResult();
    }

}
