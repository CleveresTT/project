<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Posts;
use \Datetime;


class PostsController extends AbstractController{

    private function makeJsonResponse ($response, $code = 200) : Response
    {
        return $this->json(
            $response,
            $code,
            $this->getParameter('kernel.environment') == 'dev' ? ['Access-Control-Allow-Origin'=> 'http://localhost:5173'] : []
        );
    }

    #[Route('api/posts/get_posts', name: 'get_posts')]
    public function GetPosts(PostsRepository $repository): Response
    {
        $response = $repository->findAll();

        return $this->makeJsonResponse($response);
    }

    #[Route('api/posts/get_post/{id}', name: 'get_post')]
    public function GetPost(PostsRepository $repository, $id): Response
    {
        $response = $repository->findOneBy(['id' => $id]) ?? '';
        $code = $response ? 200 : 204;

        return $this->makeJsonResponse($response, $code);
    }

    #[Route('api/posts/make_post', name: 'make_post')]
    public function MakePost(PostsRepository $repository, EntityManagerInterface $entityManager, Request $request): Response
    {

        $text = $request->request->get('text');
        $dateTimeNow = new DateTime('now');
        $code = 201;

        if ($text)
        {
            $post = new Posts();
            $post->setText($text);
            $post->setDatetime($dateTimeNow);
            $entityManager->persist($post);
            $entityManager->flush();
        }

        return $this->makeJsonResponse($repository->findAll(), $code);
    }

    #[Route('api/posts/delete_post', name: 'delete_post')]
    public function DeletePost(PostsRepository $repository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $id = $request->request->get('id');
        $code = 204;

        // if ($id)
        // {
        //     $post = $repository->find($id);
        //     $entityManager->remove($post);
        //     $entityManager->flush();

        //     $code = 201;
        // }

        return $this->makeJsonResponse($repository->findAll(), $code);
    }
}
