<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 * @UniqueEntity("title")
 */
class Ad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 15,
     *  max = 120,
     *  minMessage = "La valeur minimal du message est {{ limit }} ",
     *  maxMessage = "La valeur maximal du message est {{ limit }} "
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 30,
     *  max = 150,
     *  minMessage = "La valeur minimal du message est {{ limit }}",
     *  maxMessage = "La valeur maximal du message est {{ limit }}"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $posted_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverImage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPostedDate(): ?\DateTimeInterface
    {
        return $this->posted_date;
    }

    public function setPostedDate(\DateTimeInterface $posted_date): self
    {
        $this->posted_date = $posted_date;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @ORM/PrePersist
     * @ORM/PreUpdate
     *
     * @return void
     */
    public function initializeSlug(){
        if(empty($this->slug)){
            $slugify= new Slugify();
            $this->slug= $slugify->slugify($this->title);
        }
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
