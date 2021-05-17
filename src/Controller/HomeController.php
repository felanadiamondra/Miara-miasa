<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PersonType;
use App\Entity\Person;
use App\Entity\Entreprise;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('Home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    /**
     * @Route("/signin", name="app.signin")
     */
    public function signin(Request $request, EntityManagerInterface $manager):Response
    {
        $entr= new Entreprise();
        $pers= new Person();
        $formEnt= $this->createFormBuilder($entr)
                    ->add('nom')
                    ->add('category')
                    ->add('adresse')
                    ->add('code')
                    ->add('ville')
                    ->add('email')
                    ->add('description', TextareaType::class)
                    ->getForm();

        $formPers= $this->createForm(PersonType::class, $pers);


        $formEnt->handleRequest($request);
        if($formEnt->isSubmitted() && $formEnt->isValid())
        {
            $manager->persist($entr);
            $manager->flush();
        }
        

        return $this->render('Home/signin.html.twig', [
            'controller_name' => 'HomeController',
            'formSignUp' => $formEnt->createView(),
            'formSignUpPers' => $formPers->createView()
        ]);
    }
}
