<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PelotonRepository")
 */
class Peloton
{
    const TYPE_18 = '18 m';
    const TYPE_25 = '25 m';
    const TYPE_50_30 = '50/30';
    const TYPE_50 = '50 m';
    const TYPE_70 = '70 m';
    const TYPE_1440 = '1440';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxParticipant;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tournament", inversedBy="pelotons")
     */
    private $tournament;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="peloton")
     */
    private $participants;

    public function __construct()
    {
        $this->type             = 0;
        $this->participants     = new ArrayCollection();
        $this->startTime        = new \DateTime();
    }

    public static function getTypeList()
    {
        return array(self::TYPE_18, self::TYPE_25, self::TYPE_50_30, self::TYPE_50, self::TYPE_70, self::TYPE_1440);
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxParticipant(): ?int
    {
        return $this->maxParticipant;
    }

    public function setMaxParticipant(int $maxParticipant): self
    {
        $this->maxParticipant = $maxParticipant;

        return $this;
    }

    public function getType()
    {
        return self::getTypeList()[$this->type];
    }

    public function setType($type): void
    {
        if (!in_array($type, self::getTypeList())) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->type = array_search($type, self::getTypeList());
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): self
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setPeloton($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getPeloton() === $this) {
                $participant->setPeloton(null);
            }
        }

        return $this;
    }
}
