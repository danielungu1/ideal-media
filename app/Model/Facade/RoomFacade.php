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

}
