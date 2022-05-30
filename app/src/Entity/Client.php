<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 32)]
    #[Assert\Regex('/^[a-zA-Z]+$/')]
    #[ORM\Column(type: 'string', length: 32)]
    private ?string $firstName;

    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 32)]
    #[Assert\Regex('/^[a-zA-Z]+$/')]
    #[ORM\Column(type: 'string', length: 32)]
    private ?string $lastName;

    #[Assert\NotNull]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    #[ORM\Column(type: 'string', length: 320)]
    private ?string $email;

    #[Assert\NotNull]
    #[Assert\Regex('/^\+[1-9]\d{1,14}$/')]
    // TODO: In the example the number with the "+" prefix, maybe we should remove the plus here?! I'll ask BA.. :)
    #[ORM\Column(type: 'string', length: 16)]
    private ?string $phoneNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
