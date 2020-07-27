<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(RecipeRepository $repo, $page = 1)
    {

        return $this->render('home/index.html.twig', [
            'recipes' => $repo->findAll()
        ]);
    }
}
