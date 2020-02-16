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
     * @return string
     */
    public const ACTIVE = "Actif";

    /**
     * @return string
     */
    public const INACTIVE = "Inactif"; 

    /**
     * @return string
     */
    public const GENDER_M = "Male";

    /**
     * @return string
     */
    public const GENDER_F = "Female";

    /**
     * @return string
     */
    public const ARC_N = "";

    /**
     * @return string
     */
    public const ARC_R = "Recurve";

    /**
     * @return string
     */
    public const ARC_C = "Compound";

    /**
     * @return string
     */
    public const ARC_L = "Longbow";

    /**
     * @return string
     */
    public const ARC_NR = "Nu Recurve";

    /**
     * @return string
     */
    public const ARC_NC = "Nu Compound";

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiliate", mappedBy="archer")
     */
    private $affiliations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="archer")
     */
    private $competitions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaultArc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArcherCategory")
     */
    private $defaultCategory;

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

    public static function getGenderList()
    {
        return [self::GENDER_M, self::GENDER_F];
    }

    public static function getTypeArcList()
    {
        return [self::ARC_R, self::ARC_NR, self::ARC_C, self::ARC_NC, self::ARC_L];
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

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTime $birthdate): self
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

    public function getGender()
    {
        if($this->gender === null)
            return null;

        return self::getGenderList()[$this->gender]; 
    }

    public function setGender($gender): self
    {
        if($gender === null)
        {
            $this->gender = null;
            return $this;
        }

        if (!in_array($gender, self::getGenderList())) {
            throw new \InvalidArgumentException("Invalid gender");
        }
        $this->gender = array_search($gender, self::getGenderList());

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

    /**
     * @return bool
     */
    public function isAffiliate(): bool
    {
        return ($this->affiliations->count() > 0);
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

    public function getDefaultArc()
    {
        if($this->defaultArc === null)
            return null;

        return self::getTypeArcList()[$this->defaultArc];
    }

    public function setDefaultArc($defaultArc): self
    {
        if($defaultArc === null)
        {
            $this->defaultArc = null;
            return $this;
        }

        if (!in_array($defaultArc, self::getTypeArcList())) {
            throw new \InvalidArgumentException("Invalid arc");
        }
        $this->defaultArc = array_search($defaultArc, self::getTypeArcList());

        return $this;
    }

    public function getDefaultCategory(): ?ArcherCategory
    {
        return $this->defaultCategory;
    }

    public function setDefaultCategory(?ArcherCategory $defaultCategory): self
    {
        $this->defaultCategory = $defaultCategory;

        return $this;
    }
}
