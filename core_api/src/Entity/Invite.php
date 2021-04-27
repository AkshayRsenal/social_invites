<?php

namespace App\Entity;

use App\Repository\InviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InviteRepository::class)
 */
class Invite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="profilename")
     */
    private $profilename;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $invite_from;
    

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getProfilename(): ?User
    {
        return $this->profilename;
    }

    public function setProfilename(?User $profilename): self
    {
        $this->profilename = $profilename;

        return $this;
    }

    public function getInviteFrom(): ?string
    {
        return $this->invite_from;
    }

    public function getInvite_from(): ?string
    {
        return $this->invite_from;
    }

    public function setInviteFrom(string $invite_from): self
    {
        $this->invite_from = $invite_from;

        return $this;
    }

    
}
