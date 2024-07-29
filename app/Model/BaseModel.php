<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\DateTime;

abstract class BaseModel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct()
    {
        $date = new DateTime;
        $this->setDateCreated($date);
        $this->setDateUpdated($date);
    }

    /** @ORM\Column(type="datetime") */
    protected DateTime $dateCreated;

    /** @ORM\Column(type="datetime") */
    protected DateTime $dateUpdated;

    public function getId(): ?string
    {
        return $this->id ? (string) $this->id : null;
    }

    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

}
