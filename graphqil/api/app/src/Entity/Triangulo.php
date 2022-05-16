<?php

namespace App\Entity;

use App\Repository\TrianguloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrianguloRepository::class)]
class Triangulo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $primeroLado;

    #[ORM\Column(type: 'float', nullable: true)]
    private $segundoLado;

    #[ORM\Column(type: 'float', nullable: true)]
    private $terceiroLado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimeroLado(): ?float
    {
        return $this->primeroLado;
    }

    public function setPrimeroLado(?float $primeroLado): self
    {
        $this->primeroLado = $primeroLado;

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

    public function getTerceiroLado(): ?float
    {
        return $this->terceiroLado;
    }

    public function setTerceiroLado(?float $terceiroLado): self
    {
        $this->terceiroLado = $terceiroLado;

        return $this;
    }
}
