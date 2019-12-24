<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfX;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfTen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfNine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isForfeited;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Archer", inversedBy="participants")
     */
    private $archer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Peloton", inversedBy="participants")
     */
    private $peloton;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArcherCategory", inversedBy="participants")
     */
    private $category;

    public function __construct()
    {
        $this->points = 0;
        $this->numberOfTen = 0;
        $this->isForfeited = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getNumberOfX(): ?int
    {
        return $this->numberOfX;
    }

    public function setNumberOfX(?int $numberOfX): self
    {
        $this->numberOfX = $numberOfX;

        return $this;
    }

    public function getNumberOfTen(): ?int
    {
        return $this->numberOfTen;
    }

    public function setNumberOfTen(int $numberOfTen): self
    {
        $this->numberOfTen = $numberOfTen;

        return $this;
    }

    public function getNumberOfNine(): ?int
    {
        return $this->numberOfNine;
    }

    public function setNumberOfNine(?int $numberOfNine): self
    {
        $this->numberOfNine = $numberOfNine;

        return $this;
    }

    public function getIsForfeited(): ?bool
    {
        return $this->isForfeited;
    }

    public function setIsForfeited(bool $isForfeited): self
    {
        $this->isForfeited = $isForfeited;

        return $this;
    }

    public function getArcher(): ?Archer
    {
        return $this->archer;
    }

    public function setArcher(?Archer $archer): self
    {
        $this->archer = $archer;

        return $this;
    }

    public function getPeloton(): ?Peloton
    {
        return $this->peloton;
    }

    public function setPeloton(?Peloton $peloton): self
    {
        $this->peloton = $peloton;

        return $this;
    }

    public function getCategory(): ?ArcherCategory
    {
        return $this->category;
    }

    public function setCategory(?ArcherCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
