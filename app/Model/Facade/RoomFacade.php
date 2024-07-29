<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Room;
use Nettrine\ORM\EntityManagerDecorator;

final class RoomFacade extends BaseFacade
{

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct($em, Room::class);
    }

    public function getAvailableRooms()
    {
        return $this->getQueryBuilder()
            ->leftJoin('e.roomAvailabilities', 'r')
            ->leftJoin('r.roomReservations', 'rr')
            ->where('rr.roomAvailability IS NULL')
            ->getQuery()
            ->getResult();
    }

    public function isRoomAvailable(Room $room): bool
    {
        $roomAvailability = $this->getQueryBuilder()
            ->leftJoin('e.roomAvailabilities', 'ra')
            ->leftJoin('ra.roomReservations', 'rr')
            ->andWhere('rr.roomAvailability IS NULL')
            ->andWhere('e = :room')
            ->setParameter('room', $room)
            ->getQuery()
            ->getOneOrNullResult();

        return (bool)$roomAvailability;
    }

}
