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

    public function getAvailableRoom()
    {
        return $this->getQueryBuilder()
            ->leftJoin('e.roomAvailabilities', 'r')
            ->leftJoin('r.roomReservations', 'rr')
            ->where('rr.roomAvailability IS NULL')
            ->getQuery()
            ->getResult();
    }

}
