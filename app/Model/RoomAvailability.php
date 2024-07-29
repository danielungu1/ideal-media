<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class RoomAvailability extends BaseModel
{

    /**
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=false)
     */
    protected Room $room;

    /** @ORM\Column(type="datetime") */
    protected $availableSince;

    /** @ORM\Column(type="datetime") */
    protected $availableTill;

    //////////////////////////////////////////////////////// Getters & Setters

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    public function getAvailableSince()
    {
        return $this->availableSince;
    }

    public function setAvailableSince($availableSince): void
    {
        $this->availableSince = $availableSince;
    }

    public function getAvailableTill()
    {
        return $this->availableTill;
    }

    public function setAvailableTill($availableTill): void
    {
        $this->availableTill = $availableTill;
    }

}
