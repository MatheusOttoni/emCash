<?php

namespace App\Entity;

use App\Repository\RetanguloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetanguloRepository::class)]
class Retangulo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $primeiroLado;

    #[ORM\Column(type: 'float', nullable: true)]
    private $segundoLado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimeiroLado(): ?float
    {
        return $this->primeiroLado;
    }

    public function setPrimeiroLado(?float $primeiroLado): self
    {
        $this->primeiroLado = $primeiroLado;

        return $this;
    }

    public function getSegundoLado(): ?float
    {
        return $this->segundoLado;
    }

    public function setSegundoLado(?float $segundoLado): self
    {
        $this->segundoLado = $segundoLado;

        return $this;
    }
}
