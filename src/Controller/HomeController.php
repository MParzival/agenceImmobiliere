<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository) : Response
    {
        $properties=$repository->findLastest();
        return $this->render('home/index.html.twig', [
            'properties' => $properties,
        ]);
    }
}
