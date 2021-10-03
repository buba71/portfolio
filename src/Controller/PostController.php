<?php

declare(strict_types=1);

namespace App\Controller;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class PostController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PostController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showAll(Environment $twig): Response
    {
        $posts = $this->entityManager->getRepository(Post::class)->findAll();

        return new Response($twig->render(
            'Blog/posts.html.twig',
            [ 'posts' => $posts ]
        ));
    }

    public function showDetails(string $slug)
    {
        $post = $this->entityManager->getRepository(Post::class)->findOneBy(['slug' => $slug]);
        
        dd($post);
    }
}
