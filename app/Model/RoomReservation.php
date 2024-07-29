<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class RoomReservation extends BaseModel
{

    /**
     * @ORM\ManyToOne(targetEntity="UserAccount")
     * @ORM\JoinColumn(name="user_account_id", referencedColumnName="id", nullable=false)
     */
    protected UserAccount $userAccount;

    /**
     * @ORM\ManyToOne(targetEntity="RoomAvailability")
     * @ORM\JoinColumn(name="room_availability_id", referencedColumnName="id", nullable=false)
     */
    protected RoomAvailability $room;

    //////////////////////////////////////////////////////// Getters & Setters

    public function getUserAccount(): UserAccount
    {
        return $this->userAccount;
    }

    public function setUserAccount(UserAccount $userAccount): void
    {
        $this->userAccount = $userAccount;
    }

    public function getRoom(): RoomAvailability
    {
        return $this->room;
    }

    public function setRoom(RoomAvailability $room): void
    {
        $this->room = $room;
    }

}
