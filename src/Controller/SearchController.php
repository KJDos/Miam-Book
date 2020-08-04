<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    
    /**
     * @Route("/recherche", name="search")
     */
    public function recherche(Request $request, RecipeRepository $repo) {

        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);
        $recipes = [];
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
 
            $name = $searchForm->getData()->getname();

            $recipes = $repo->searchName($name);


            if ($recipes == null) {
                $this->addFlash('warning', 'Aucune recette comportant ce terme n\'a été trouvé.');
           
            }

    }


        return $this->render('search/index.html.twig',[
            'recipes' => $recipes,
            'searchForm' => $searchForm->createView()
        ]);
    }


}