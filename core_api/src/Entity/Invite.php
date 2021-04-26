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
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="profilename")
     */
    private $collectionprofiles;

    public function __construct()
    {
        $this->collectionprofiles = new ArrayCollection();
    }


    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCollectionprofiles(): ?User
    {
        return $this->collectionprofiles;
    }

    public function setCollectionprofiles(?User $collectionprofiles): self
    {
        $this->collectionprofiles = $collectionprofiles;

        return $this;
    }

    public function addCollectionprofile(User $collectionprofile): self
    {
        if (!$this->collectionprofiles->contains($collectionprofile)) {
            $this->collectionprofiles[] = $collectionprofile;
            $collectionprofile->setProfilename($this);
        }

        return $this;
    }

    public function removeCollectionprofile(User $collectionprofile): self
    {
        if ($this->collectionprofiles->removeElement($collectionprofile)) {
            // set the owning side to null (unless already changed)
            if ($collectionprofile->getProfilename() === $this) {
                $collectionprofile->setProfilename(null);
            }
        }

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


}
