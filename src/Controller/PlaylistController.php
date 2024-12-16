<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlaylistController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    #[Route(path: '/playlists', name: 'playlists')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $user = $this->userRepository->findOneBy([
            'username' => $this->getUser()->getUserIdentifier()
        ]);

        $playlists = $user->getPlaylists();

        return $this->render('lists.html.twig', [
            'playlists' => $playlists
        ]);
    }
}
