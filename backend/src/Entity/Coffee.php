<?php

namespace App\Entity;

use App\Repository\CoffeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoffeeRepository::class)]
class Coffee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CoffeeType $type = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CoffeeIntensity $intensity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CoffeeSize $size = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?CoffeeType
    {
        return $this->type;
    }

    public function setType(?CoffeeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getIntensity(): ?CoffeeIntensity
    {
        return $this->intensity;
    }

    public function setIntensity(?CoffeeIntensity $intensity): static
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getSize(): ?CoffeeSize
    {
        return $this->size;
    }

    public function setSize(?CoffeeSize $size): static
    {
        $this->size = $size;

        return $this;
    }
}
