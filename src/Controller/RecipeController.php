<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/recette")
 */
class RecipeController extends AbstractController
{

    /**
     * @Route("/nouvelle", name="recipe_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            foreach ($recipe->getSteps() as $step) {
                $step->setRecipe($recipe);
                $this->getDoctrine()->getManager()->persist($step);
            }

            foreach ($recipe->getIngredients() as $ingredient) {
                $ingredient->setRecipe($recipe);
                $this->getDoctrine()->getManager()->persist($ingredient);
            }

            $recipe->setAuthor($this->getUser());

            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'La recette a été crée.');
            return $this->redirectToRoute('recipe_show', ['slug' => $recipe->getSlug()]);
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="recipe_show", methods={"GET"})
     * 
     */
    public function show(Recipe $recipe): Response
    {
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="recipe_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER') and user === recipe.getAuthor()")
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($recipe->getSteps() as $step) {
                $step->setRecipe($recipe);
                $this->getDoctrine()->getManager()->persist($step);
            }

            foreach ($recipe->getIngredients() as $ingredient) {
                $ingredient->setRecipe($recipe);
                $this->getDoctrine()->getManager()->persist($ingredient);
            }


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La recette a été modifiée.');

            return $this->redirectToRoute('recipe_show', ['slug' => $recipe->getSlug()]);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="recipe_delete", methods={"DELETE"})
     * @Security("is_granted('ROLE_USER') and user === recipe.getAuthor()")
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_index');
    }

}
