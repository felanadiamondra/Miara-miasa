<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SigninType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

     /**
     * @Route("/signin", name="app.signin")
     */

    public function signin(){
        $signForm= $this-> createForm(SigninType::class);
        return $this->render('security/signin.html.twig', [
            'formSignIn' => $signForm->createView()
        ]);
    }
}
