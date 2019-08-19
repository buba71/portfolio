<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ApiResource(attributes = {
 *     "normalization_context"={ "groups" = {"post", "tags"} },
 *     "denormalization_context"={ "groups" = {"post", "tags"} }
 * })
 * @ApiFilter(SearchFilter::class, properties={"tags.name": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"post"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"post"})
     */
    private $postDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez ajouter un titre pour cet article.")
     * @Groups({"post"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="L'article ne peut être vide.")
     * @Groups({"post"})
     */
    private $content;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     * @Groups({"post"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist", "remove"})
     * @Groups({"tags"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->postDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId():?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPostDate():?\DateTimeInterface
    {
        return $this->postDate;
    }

    /**
     * @return mixed
     */
    public function getTitle():?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent():?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string|null
     */
    public function getSlug():?string
    {
        return $this->slug;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getTags():?Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }
}
