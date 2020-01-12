<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArcherRepository")
 */
class Archer
{
    /**
     * @return integer
     */
    public const ACTIVE = "Actif";

    /**
     * @return integer
     */
    public const INACTIVE = "Inactif"; 

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiliate", mappedBy="archer")
     */
    private $affiliations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="archer")
     */
    private $competitions;

    public function __construct()
    {
        $this->status = 1;
        $this->affiliations = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }

    public static function getStatusList()
    {
        return [self::INACTIVE, self::ACTIVE];
    }  

    public function getFullname()
    {
        return $this->getlastname() . ' ' . $this->getFirstname(); 
    }
    
    public function __ToString()
    {
        return $this->getFullname(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeZone
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeZone $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getStatus()
    {
        return self::getStatusList()[$this->status]; 
    }

    public function setStatus($status): self
    {
        if (!in_array($status, self::getStatusList())) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = array_search($status, self::getStatusList());

        return $this;
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getAffiliations(): Collection
    {
        return $this->affiliations;
    }

    /**
     * @return Affiliate
     */
    public function getCurrentAffiliation(): Affiliate
    {
        return $this->affiliations->last();
    }

    public function addAffiliation(Affiliate $affiliation): self
    {
        if (!$this->affiliations->contains($affiliation)) {
            $this->affiliations[] = $affiliation;
            $affiliation->setArcher($this);
        }

        return $this;
    }

    public function removeAffiliation(Affiliate $affiliation): self
    {
        if ($this->affiliations->contains($affiliation)) {
            $this->affiliations->removeElement($affiliation);
            // set the owning side to null (unless already changed)
            if ($affiliation->getArcher() === $this) {
                $affiliation->setArcher(null);
            }
        }

        return $this;
    } 

    /**
     * @return Collection|Participant[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Participant $participant): self
    {
        if (!$this->competitions->contains($participant)) {
            $this->competitions[] = $participant;
            $participant->setArcher($this);
        }

        return $this;
    }

    public function removeCompetition(Participant $participant): self
    {
        if ($this->competitions->contains($participant)) {
            $this->competitions->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getArcher() === $this) {
                $participant->setArcher(null);
            }
        }

        return $this;
    }
}
