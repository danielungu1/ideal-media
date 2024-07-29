<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Room extends BaseModel
{

    /** @ORM\Column(type="string") */
    protected string $name;

    /** @ORM\OneToMany(targetEntity="RoomReservation", mappedBy="room", cascade={"persist"}) */
    protected $roomReservations;

    //////////////////////////////////////////////////////// Getters & Setters

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRoomReservations()
    {
        return $this->roomReservations;
    }

    public function setRoomReservations($roomReservations): void
    {
        $this->roomReservations = $roomReservations;
    }

}
