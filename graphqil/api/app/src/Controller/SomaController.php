<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrianguloRepository;
use App\Repository\RetanguloRepository;

class SomaController extends AbstractController
{
    private $trianguloRepository;
    private $retanguloRepository;

    public function __construct(TrianguloRepository $trianguloRepository, RetanguloRepository $retanguloRepository)
    {
        $this->trianguloRepository = $trianguloRepository;
        $this->retanguloRepository = $retanguloRepository;
    }

    #[Route('/soma', name: 'app_soma', methods:['GET'])]
    public function index(): Response
    {

        $areaTriangulo = 0;
        $areaRetangulo = 0;
        $triangulos = $this->trianguloRepository->findAll();
        $retangulos = $this->retanguloRepository->findAll();

        if ($triangulos){
            foreach($triangulos as $triangulo){
                $base = $triangulo->getPrimeroLado();
                $lado1 = $triangulo->getSegundoLado();
                $lado2 = $triangulo->getTerceiroLado();
                $altura = $this->alturaTriangulo($base, $lado1, $lado2);
                $areaTriangulo += $this->areaTriangulo($base, $altura); 
            }
        }

        if ($retangulos){
            foreach($retangulos as $retangulo){
                $lado1 = $retangulo->getPrimeiroLado();
                $lado2 = $retangulo->getSegundoLado();
                $areaRetangulo += $this->areaRetangulo($lado1, $lado2);
            }
        }

        $areaTotal = $areaRetangulo + $areaTriangulo;

        
        return $this->json([
            'data' => 'Area total '. $areaTotal,
            'erros' => false,
        ]);
    }

    public function alturaTriangulo(float $a, float $b, float $c): float 
    {
     return ($a+$b+$c) / 2;
    }

    public function areaTriangulo(float $b, float $a): float 
    {
     return ($a * $b) / 2;
    }

    public function areaRetangulo(float $a, float $b): float 
    {
     return $a * $b;
    }

}
