<?php
declare (strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionsController extends AbstractController
{
    #[Route(path: '/subscriptions', name: 'subscriptions')]
    public function mySubscriptions(): Response
    {
        return $this->render(view: 'abonnements.html.twig');
    }
}