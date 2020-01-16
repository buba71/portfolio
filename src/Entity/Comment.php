<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"comments"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"comments"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez entrer un pseudo valide.")
     * @Groups({"comments"})
     */
    private $author;

    /**
     * @ORM\Column(type="text", length=255, nullable=false)
     * @Assert\NotBlank(message="Votre commentaire ne peut être vide.")
     * @Groups({"comments"})
     */
    private $content;

    /**
     * Many comments have only one post. This is the owning side.
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", nullable=false)
     */
    private $post;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function setPost(Post $post):self
    {
        $this->post = $post;

        return $this;
    }
}
