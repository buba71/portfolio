<?php

namespace App\EventSubscriber;

use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class PostCheckUniqueTagSubscriberTest extends TestCase
{
    private $event;
    private $entityManager;
    private $request;
    private $repository;


    public function setUp(): void
    {
        $this->event = $this->createMock(GetResponseForControllerResultEvent::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->repository =$this->createMock(TagRepository::class);
        $this->request = $this->createMock(Request::class);
    }

    public function testIfTagAlreadyExistOnBdd(): void
    {
        // Create fake tags to put in Tag repository.
        $tag_1 = new Tag();
        $tag_1->setName('symfony');

        $tag_2 = new Tag();
        $tag_2->setName('docker');

        $oldTags = [$tag_1, $tag_2];

        // Create a new Post for test with tag_1.
        $newPost = new Post();
        $newPost->setTitle('Title');
        $newPost->setContent('Content');
        $newPost->addTag($tag_1);

        // Create TagRepository Stub.
        $this->repository->expects($this->once())
                         ->method('findAll')
                         ->willReturn($oldTags);
        // Create GetRepository method in entityManager Mock.
        $this->entityManager->expects($this->once())
                            ->method('getRepository')
                            ->willReturn($this->repository);
        // Create Request stub.
        $this->request->expects($this->once())
                      ->method('getMethod')
                      ->willReturn('POST');
        // Create Event Stub.
        $this->event->expects($this->once())
                    ->method('getRequest')
                    ->willReturn($this->request);

        $this->event->expects($this->once())
                    ->method('getControllerResult')
                    ->willReturn($newPost);

        $tagFilter = new PostCheckUniqueTagSubscriber($this->entityManager);
        $tagFilter->tagsFilter($this->event);

        static::assertArrayHasKey(1, $newPost->getTags());
        static::assertEquals('symfony', $newPost->getTags()[1]->getName());
    }
}

