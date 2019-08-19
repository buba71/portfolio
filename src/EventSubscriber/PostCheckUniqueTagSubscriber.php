<?php

namespace App\EventSubscriber;

use App\Entity\Post;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PostCheckUniqueTagSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
          kernelEvents::VIEW => ['tagsFilter', EventPriorities::PRE_WRITE],
        ];
    }

    /**
     * Check if input tags already exists in BDD
     * @param GetResponseForControllerResultEvent $event
     */
    public function tagsFilter(GetResponseForControllerResultEvent $event)
    {
        $post = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$post instanceof Post || Request::METHOD_DELETE == $method) {
            return;
        }

        $oldTags = $this->entityManager->getRepository(Tag::class)->findAll();

        // Check if Tags already exist in bdd.
        foreach ($oldTags as $oldTag) {
            foreach (($post->getTags()) as $newTag) {
                if ($newTag->getName() === $oldTag->getName()) {
                    $post->removeTag($newTag);
                    $post->addTag($oldTag);
                }
            }
        }
    }
}
