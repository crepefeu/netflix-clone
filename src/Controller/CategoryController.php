<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    #[Route(path: '/category/{id}', name: 'category')]
    public function category(
        string $id,
        CategoryRepository $categoryRepository
    ): Response {
        // Find the category with the given id
        $category = $categoryRepository->find($id);
        $categories = $categoryRepository->findAll();
        return $this->render(view: 'category.html.twig', parameters: [
            'category' => $category, 'categories' => $categories
        ]);
    }
}
