<?php

namespace App\Entity;

use App\Entity\Peloton;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TournamentRepository")
 */
class Tournament
{
    /**
     * @return Array
     */
    public const TYPE = [
        0 => 'indoor'
        , 1 => 'outdoor' 
    ];

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
     * @ORM\OneToMany(targetEntity="App\Entity\Peloton", mappedBy="tournament", cascade={"remove"})
     */
    private $pelotons;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;

    public function __construct()
    {
        $this->type     = 0;
        $this->pelotons = new ArrayCollection();
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
        $this->attachments = new ArrayCollection();
    }

    public function __ToString()
    {
        return $this->getTitle();
    }

    public static function getTypeList()
    {
        return self::TYPE;
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

    /**
     * @return Collection|Participant[]
     */
    public function getListParticipants()
    {
        $listParticipants = new ArrayCollection();
        if(!empty($this->getPelotons()))
        {
            foreach($this->getPelotons() as $peloton)
            {
                foreach($peloton->getParticipants() as $participant)
                {
                    $listParticipants->add($participant);
                }
            }
        }
        return $listParticipants;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        $slugger = new AsciiSlugger();
        $this->setSlug($slugger->slug($this->getId() . $this->title));

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }
}
