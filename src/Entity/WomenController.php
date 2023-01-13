<?php

namespace App\Entity;

use App\Repository\WomenControllerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WomenControllerRepository::class)]
class WomenController
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
