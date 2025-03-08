<?php

namespace App\Entity;

use App\Enum\CoffeeSize as CoffeeSizeEnum;
use App\Repository\CoffeeSizeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoffeeSizeRepository::class)]
class CoffeeSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true, enumType: CoffeeSizeEnum::class)]
    private ?CoffeeSizeEnum $size = null;

    public function __construct(string $size)
    {
        $this->size = CoffeeSizeEnum::from($size);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?CoffeeSizeEnum
    {
        return $this->size;
    }

    public function setSize(CoffeeSizeEnum $size): static
    {
        $this->size = $size;

        return $this;
    }
}
