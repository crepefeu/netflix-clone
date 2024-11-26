<?php

namespace App\Entity;

use App\Enum\CommentStatusEnum;
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(enumType: CommentStatusEnum::class)]
    private ?CommentStatusEnum $status = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'comments')]
    private Collection $userIdentifier;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parentComment')]
    private ?self $childComments = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'childComments')]
    private Collection $parentComment;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $media = null;

    public function __construct()
    {
        $this->userIdentifier = new ArrayCollection();
        $this->parentComment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?CommentStatusEnum
    {
        return $this->status;
    }

    public function setStatus(CommentStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserIdentifier(): Collection
    {
        return $this->userIdentifier;
    }

    public function addUserIdentifier(User $userIdentifier): static
    {
        if (!$this->userIdentifier->contains($userIdentifier)) {
            $this->userIdentifier->add($userIdentifier);
            $userIdentifier->setComments($this);
        }

        return $this;
    }

    public function removeUserIdentifier(User $userIdentifier): static
    {
        if ($this->userIdentifier->removeElement($userIdentifier)) {
            // set the owning side to null (unless already changed)
            if ($userIdentifier->getComments() === $this) {
                $userIdentifier->setComments(null);
            }
        }

        return $this;
    }

    public function getChildComments(): ?self
    {
        return $this->childComments;
    }

    public function setChildComments(?self $childComments): static
    {
        $this->childComments = $childComments;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParentComment(): Collection
    {
        return $this->parentComment;
    }

    public function addParentComment(self $parentComment): static
    {
        if (!$this->parentComment->contains($parentComment)) {
            $this->parentComment->add($parentComment);
            $parentComment->setChildComments($this);
        }

        return $this;
    }

    public function removeParentComment(self $parentComment): static
    {
        if ($this->parentComment->removeElement($parentComment)) {
            // set the owning side to null (unless already changed)
            if ($parentComment->getChildComments() === $this) {
                $parentComment->setChildComments(null);
            }
        }

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): static
    {
        $this->media = $media;

        return $this;
    }
}
