<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Retangulo;
use App\Repository\RetanguloRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/retangulo', name: 'app_retangulo', methods:['GET'])]
class RetanguloController extends AbstractController
{
    private $retanguloRepository;
    private $doctrine;

    public function __construct(RetanguloRepository $retanguloRepository, ManagerRegistry $doctrine)
    {
        $this->retanguloRepository = $retanguloRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $retangulos = $this->retanguloRepository->findAll(); 
        return $this->json([
            'data' => $retangulos
        ]);
    }

    #[Route('/create', name: 'create_retangulo', methods:['POST'])]
    public function create(Request $request): Response
    {
        $entityManager = $this->doctrine->getManager();

        $data = $request->request->all();

        if ($data['primeiroLado'] == $data['segundoLado'] || $data['primeiroLado'] <= 0 || $data['segundoLado'] <= 0){
            return $this->json([
                'data' => 'Retangulo não foi criado! ',
                'erros' => 'As medidas dos lados do retangulo devem ser maior que 0 e diferentes!'
            ]);
        }

        $retangulo = new Retangulo();
        $retangulo->setPrimeiroLado($data['primeiroLado']);
        $retangulo->setSegundoLado($data['segundoLado']);
        $entityManager->persist($retangulo);
        $entityManager->flush();

        return $this->json([
            'data' => 'Retangulo criado com sucesso! '.$retangulo->getId(),
            'erros' => false
        ]);

    }
}
