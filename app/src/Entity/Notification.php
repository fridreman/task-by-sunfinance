<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(required: true, example: 1, openapiContext: ["type" => "integer"])]
    private ?Client $client;

    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^(sms|email)$/')]
    #[ORM\Column(type: 'string', length: 5)]
    #[ApiProperty(required: true, default: "sms", example: "email")]
    private ?string $channel;

    #[Assert\Length(min: 0, max: 140)]
    #[ORM\Column(type: 'string', length: 140, nullable: false)]
    #[ApiProperty(required: true, default: "Some text", example: "lorem ipsum dolor sit amet")]
    private ?string $content;

    #[ORM\Column(type: 'boolean', options: ["default" => false])]
    #[ApiProperty(readable: true, writable: false)]
    private ?bool $delivered = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isDelivered(): ?bool
    {
        return $this->delivered;
    }

    public function setDelivered(?bool $delivered): self
    {
        $this->delivered = $delivered;

        return $this;
    }
}
