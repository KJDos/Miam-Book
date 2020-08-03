<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="home_index")
     */
    public function index(RecipeRepository $repo, $page)
    {
        $limit = 2;

        $start = $page * $limit - $limit;

        $total = count($repo->findAll());

        $pages = ceil($total / $limit);

        return $this->render('home/index.html.twig', [
            'recipes' => $repo->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page
        ]);
    }
}
