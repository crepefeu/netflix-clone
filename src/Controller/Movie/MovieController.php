<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends AbstractController
{
    #[Route(path: '/movie/{id}', name: 'movie')]
    public function movie(
        string $id,
        MovieRepository $movieRepository
    ): Response {
        // Find the movie with the given id
        $movie = $movieRepository->find($id);
        return $this->render(view: 'detail.html.twig', parameters: [
            'movie' => $movie
        ]);
    }
}
