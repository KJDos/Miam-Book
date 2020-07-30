<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @Route("/user/{slug}", name="user_show", methods={"GET"})
     * 
     */
    public function show(User $user): Response
    {
        return $this->render('account/index.html.twig', [
            'recipe' => $user,
        ]);
    }
}
