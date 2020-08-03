<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestfiltreController extends AbstractController
{
    /**
     * @Route("/tag/{category}", name="testfiltre")
     */
    public function index(RecipeRepository $repo, $category)
    {
        $recipes = $repo->afficherCategory($category);

        return $this->render('test/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
