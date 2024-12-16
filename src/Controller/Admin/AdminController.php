<?php
declare (strict_types= 1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function home(): Response
    {
        return $this->render(view: 'admin.html.twig');
    }

    #[Route(path:'/admin/movies', name:'admin_movies')]
    #[IsGranted('ROLE_ADMIN')]
    public function movies(): Response {
        return $this->render(view:'admin_movies.html.twig');
    }

    #[Route(path:'admin/users', name:'admin_users')] 
    #[IsGranted('ROLE_ADMIN')]
    public function users(): Response {
        return $this->render(view:'admin_users.html.twig');
    }

    #[Route(path:'admin/upload', name:'admin_upload')]
    #[IsGranted('ROLE_ADMIN')]
    public function upload(): Response {
        return $this->render(view:'upload.html.twig');
    }
}