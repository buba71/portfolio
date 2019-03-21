<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sendedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="Votre prénom est requis.")
     * @Assert\Length(min="3", minMessage="Ce champ doit contenir au moin 3 caractères.")
     */
    private $senderFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="Votre nom est requis.")
     * @Assert\Length(min="3", minMessage="Ce champ doit contenir au moin 3 caractères.")
     */
    private $senderLastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Votre adresse mail est requise.")
     * @Assert\Email(message="Format erroné.")
     */
    private $senderMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $messageObj;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Votre message est vide.")
     * @Assert\Length(min="3", minMessage="Ce message n'est pas valide.")
     */
    private $content;

    public function __construct()
    {
        $this->sendedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendedAt(): ?\DateTimeInterface
    {
        return $this->sendedAt;
    }

    // public function setSendedAt(\DateTimeInterface $sendedAt): self
    // {
    //   $this->sendedAt = $sendedAt;

    //    return $this;
    //}

    public function getSenderFirstName(): ?string
    {
        return $this->senderFirstName;
    }

    public function setSenderFirstName(string $senderFirstName): self
    {
        $this->senderFirstName = $senderFirstName;

        return $this;
    }

    public function getSenderLastName(): ?string
    {
        return $this->senderLastName;
    }

    public function setSenderLastName(string $senderLastName): self
    {
        $this->senderLastName = $senderLastName;

        return $this;
    }

    public function getSenderMail(): ?string
    {
        return $this->senderMail;
    }

    public function setSenderMail(?string $senderMail): self
    {
        $this->senderMail = $senderMail;

        return $this;
    }


    public function getMessageObj(): ?string
    {
        return $this->messageObj;
    }

    public function setMessageObj(?string $messageObj): self
    {
        $this->messageObj = $messageObj;

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
}
