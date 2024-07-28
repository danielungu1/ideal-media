<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Nette\Security\Passwords;

/**
 * @ORM\Entity
 */
class UserAccount extends BaseModel
{

    /** @ORM\Id */
    private ?string $id = null;

    /** @ORM\Column(type="string") */
    protected string $email;

    /** @ORM\Column(type="string") */
    protected string $password;

    //////////////////////////////////////////////////////// Getters & Setters

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = (new Passwords)->hash($password);
    }

}
