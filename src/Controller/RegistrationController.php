<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


final class RegistrationController extends AbstractController
{
    #[Route(path: '/registration', name: 'app_registration', methods:['GET', 'POST'])]
    public function registrer(Request $request, UserPasswordHasherInterface $hacher, EntityManagerInterface $em):Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $user->setUsername($user->getUsername())
                ->setEmail($user->getEmail())
                ->setPassword($hacher->hashPassword($user, $user->getPassword()));

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Vos données sont enregistrées avec succès' );

            // return $this->redirectToRoute('users/connexion.html.twig');
            return $this->redirectToRoute('home');

        }

        return $this->render('users/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
