<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Triangulo;
use App\Repository\TrianguloRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/triangulo', name: 'app_triangulo', methods:['GET'])]
class TrianguloController extends AbstractController
{
    private $trianguloRepository;
    private $doctrine;

    public function __construct(TrianguloRepository $trianguloRepository, ManagerRegistry $doctrine)
    {
        $this->trianguloRepository = $trianguloRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $triangulos = $this->trianguloRepository->findAll(); 
        return $this->json([
            'data' => $triangulos
        ]);
    }

    #[Route('/create', name: 'create_triangulo', methods:['POST'])]
    public function create(Request $request): Response
    {
        $entityManager = $this->doctrine->getManager();

        $data = $request->request->all();

        if ($data['primeiroLado'] <= 0 || $data['segundoLado'] <= 0 || $data['terceiroLado'] <= 0){
            return $this->json([
                'data' => 'Triangulo não foi criado! ',
                'erros' => 'As medidas dos lados do triangulo devem ser maior que zero'
            ]);
        }

        $triangulo = new Triangulo();
        $triangulo->setPrimeroLado($data['primeiroLado']);
        $triangulo->setSegundoLado($data['segundoLado']);
        $triangulo->setTerceiroLado($data['terceiroLado']);
        $entityManager->persist($triangulo);
        $entityManager->flush();

        return $this->json([
            'data' => 'Triangulo criado com sucesso! '.$triangulo->getId(),
            'erros' => false
        ]);

    }
}
