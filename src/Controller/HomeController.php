<?php
declare (strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route(path: '/accueil', name: 'homepage')]
    public function accueil(): Response
    {
        return $this->render(view: 'index.html.twig');
    }
}