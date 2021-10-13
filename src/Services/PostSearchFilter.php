<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

final class PostSearchFilter
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function search(string $tag)
    {
        return $this->entityManager->getRepository(Post::class)->findByTag($tag);
    }

}