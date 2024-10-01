<?php
declare (strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class ListsController extends AbstractController
{
    #[Route(path: '/my-lists', name: 'my_lists')]
    public function myLists(): Response
    {
        return $this->render(view: 'lists.html.twig');
    }
}