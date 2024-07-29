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

    /** @ORM\OneToMany(targetEntity="RoomAvailability", mappedBy="room", cascade={"persist"}) */
    protected $roomAvailabilities;

    //////////////////////////////////////////////////////// Getters & Setters

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAvailabilities()
    {
        return $this->roomAvailabilities;
    }

    public function setAvailabilities($roomAvailabilities): void
    {
        $this->roomAvailabilities = $roomAvailabilities;
    }

}
