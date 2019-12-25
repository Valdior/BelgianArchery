<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubRepository")
 */
class Club
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $acronym;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="clubs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiliate", mappedBy="club")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tournament", mappedBy="organizer")
     */
    private $tournaments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Archer")
     */
    private $owner;

    public function __construct()
    {
        $this->archer = new ArrayCollection();
        $this->tournaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    public function setAcronym(string $acronym): self
    {
        $this->acronym = $acronym;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getMembersActif(): Collection
    {
        return $this->members->filter(function(Affiliate $affiliate) {
            return $affiliate->getAffiliateEnd() == null;
        }); 
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getMembersInactif(): Collection
    {
        return $this->members->filter(
            function($entry) {
               return in_array($entry->getAffiliateEnd(), !null);
            }
        ); 
    }

    public function addMember(Affiliate $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setClub($this);
        }
        return $this;
    }

    public function removeMember(Affiliate $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getClub() === $this) {
                $member->setClub(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Tournament[]
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): self
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments[] = $tournament;
            $tournament->setOrganizer($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): self
    {
        if ($this->tournaments->contains($tournament)) {
            $this->tournaments->removeElement($tournament);
            // set the owning side to null (unless already changed)
            if ($tournament->getOrganizer() === $this) {
                $tournament->setOrganizer(null);
            }
        }

        return $this;
    }

    public function getOwner(): Archer
    {
        return $this->owner;
    }

    public function setOwner(Archer $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
