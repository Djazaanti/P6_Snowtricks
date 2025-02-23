<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController 
{
    #[Route('/', 'home', methods:['GET'])]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

}