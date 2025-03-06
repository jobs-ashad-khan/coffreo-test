<?php

namespace App\Entity;

use App\Enum\CoffeeOrderStatus;
use App\Repository\CoffeeOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoffeeOrderRepository::class)]
class CoffeeOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Coffee $coffee = null;

    #[ORM\Column(type: 'string', enumType: CoffeeOrderStatus::class)]
    private ?CoffeeOrderStatus $status = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoffee(): ?Coffee
    {
        return $this->coffee;
    }

    public function setCoffee(?Coffee $coffee): static
    {
        $this->coffee = $coffee;

        return $this;
    }

    public function getStatus(): ?CoffeeOrderStatus
    {
        return $this->status;
    }

    public function setStatus(CoffeeOrderStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
