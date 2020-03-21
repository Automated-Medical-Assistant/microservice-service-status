<?php

namespace App\Controller;

use App\Repository\NumberListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatusPageController extends AbstractController
{
    /**
     * @var NumberListRepository
     */
    private NumberListRepository $numberListRepository;

    public function __construct(NumberListRepository $numberListRepository)
    {
        $this->numberListRepository = $numberListRepository;
    }

    /**
     * @Route("/status/{number}", name="status_page")
     */
    public function index(string $number): jsonResponse
    {
        $result = $this->numberListRepository->findOneBy(['number' => $number]);
        
        return $this->json([
            'message' => $result->getStatus() ? 'infected' : 'not infected',
        ]);
    }
}
