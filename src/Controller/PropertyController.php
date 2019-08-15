<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    // a choisir soit :
    // faire l'injection du repository dans le constructor si on a plusieures méthodes
    // ou faire l'injection dans la methode quand on a peu de methodes
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * PropertyController constructor.
     * @param PropertyRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(PropertyRepository $repository, ObjectManager $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="app_property")
     */
    public function index() : Response
    {
        return $this->render('property/login.html.twig', [
            'current_name' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param \App\Entity\Property $property
     * @param string $slug
     * @return Response
     */
    public function show(\App\Entity\Property $property, string $slug): Response{
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
