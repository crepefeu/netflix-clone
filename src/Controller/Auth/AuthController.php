<?php
declare (strict_types= 1);

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    #[Route(path: '/register', name: 'register')]
    public function register(): Response {
        return $this->render('register.html.twig');
    }

    #[Route(path:'/login', name:'login')]
    public function login(): Response {
        return $this->render(view: 'login.html.twig');
    }

    #[Route(path:'/logout', name:'logout')]
    public function logout(): Response {
        return $this->redirectToRoute(route: 'homepage');
    }

    #[Route(path:'/confirm', name:'confirm')]
    public function confirm(): Response {
        return $this->render(view:'confirm.html.twig');
    }

    #[Route(path:'/forgot', name:'forgot')]
    public function forgot(): Response {
        return $this->render(view:'forgot.html.twig');
    }
}