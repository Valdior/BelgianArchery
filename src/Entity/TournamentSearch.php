<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TournamentSearchRepository")
 */
class TournamentSearch
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
     * @ORM\Column(type="integer")
     */
    private $type;

    public static function getTypeList()
    {
        return [self::TYPE_INDOOR, self::TYPE_OUTDOOR];
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType()
    {
        if($this->type === null)
            return null;

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
}