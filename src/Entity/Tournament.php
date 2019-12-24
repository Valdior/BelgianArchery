<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TournamentRepository")
 */
class Tournament
{
    public const TYPE_INDOOR = 'indoor';
    public const TYPE_OUTDOOR = 'outdoor';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="tournaments")
     */
    private $organizer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Peloton", mappedBy="tournament")
     */
    private $pelotons;

    public function __construct()
    {
        $this->type     = 0;
        $this->pelotons = new ArrayCollection();
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
    }

    public static function getTypeList()
    {
        return [self::TYPE_INDOOR, self::TYPE_OUTDOOR];
    }  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getType()
    {
        return self::getTypeList()[$this->type]; 
    }

    public function setType($type): self
    {
        if (!in_array($type, self::getTypeList())) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->type = array_search($type, self::getTypeList());
        return $this;
    }

    public function getOrganizer(): ?Club
    {
        return $this->organizer;
    }

    public function setOrganizer(?Club $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * @return Collection|Peloton[]
     */
    public function getPelotons(): Collection
    {
        return $this->pelotons;
    }

    public function addPeloton(Peloton $peloton): self
    {
        if (!$this->pelotons->contains($peloton)) {
            $this->pelotons[] = $peloton;
            $peloton->setTournament($this);
        }

        return $this;
    }

    public function removePeloton(Peloton $peloton): self
    {
        if ($this->pelotons->contains($peloton)) {
            $this->pelotons->removeElement($peloton);
            // set the owning side to null (unless already changed)
            if ($peloton->getTournament() === $this) {
                $peloton->setTournament(null);
            }
        }

        return $this;
    }
}
