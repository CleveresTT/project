<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController{

    #[Route('api/', name: 'home')]
    public function index(): Response
    {
        return $this->json('Not Found', 404);
    }
}
