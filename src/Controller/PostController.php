<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Tag;
use App\Forms\CommentType;
use App\Services\PostSearchFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

final class PostController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * PostController constructor.
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(EntityManagerInterface $entityManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    /**
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showAll(
        PostSearchFilter $searchFilter,
        Request $request,
        SessionInterface $session
    ): Response {
        if ($request->get('tag')) {
            // set session with selected tag for building breadcrumb navigation
            $session->set('tag', $request->get('tag'));

            $posts = $searchFilter->search($request->get('tag'));
        } else {
            $session->remove('tag');
            $posts = $this->entityManager->getRepository(Post::class)->findAll();
        }

        $tags = $this->entityManager->getRepository(Tag::class)->findAll();

        return new Response($this->twig->render(
            'Blog/posts.html.twig',
            [
                'posts' => $posts,
                'tags'  => $tags
            ]
        ));
    }

    /**
     * @param string $slug
     * @param FormFactoryInterface $formFactory
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showDetails(
        FlashBagInterface $flashBag,
        FormFactoryInterface $formFactory,
        Request $request,
        string $slug,
        RouterInterface $router
    ): Response {
        $post = $this->entityManager->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        $comment = new Comment();
        $commentForm = $formFactory->createBuilder(CommentType::class, $comment)->getForm();
        
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();
            $comment->setPost($post);
            
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            $flashBag->add('success', 'Votre commentaire a bien  été ajouté');

            $url = $router->generate(
                'show_details',
                [
                    "slug" => $slug,
                ]
            );

            return new RedirectResponse($url);
        }
        
        return new Response($this->twig->render(
            'Blog/post-details.html.twig',
            [
                'post' => $post,
                'form' => $commentForm->createView()
            ]
        ));
    }
}
