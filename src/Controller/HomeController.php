<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PersonType;
use App\Entity\Person;
use App\Entity\Entreprise;
use App\Entity\Category;

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
     * @Route("/signup", name="app.signup")
     */
    public function signup(
        Request $request, 
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
        ):Response
    {
        $entr= new Entreprise();
        $pers= new Person();
        $formEnt= $this->createFormBuilder($entr)
                    ->add('nom')
                    ->add('category', EntityType::class, [
                        'class'=> Category::class,
                        'choice_label' =>'name'
                    ])
                    ->add('password', PasswordType::class)
                    ->add('confirmpass', PasswordType::class)
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
            $passhash=$encoder->encodePassword($entr, $entr->getPassword());
            $entr->setPassword($passhash);
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
