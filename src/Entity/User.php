<?php

namespace App\Entity;

use App\Entity\Archer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Archer")
     */
    private $archer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenPassword;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdTokenPasswordAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->enabled = false;
    }

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add role
     */ 
    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }
    /**
     * Remove role
     */ 
    public function removeRole(string $role)
    {
        $this->roles->removeElement($role);
    }
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
    }

    public function getArcher() : ?Archer
    {
        return $this->archer;
    }

    public function setArcher(Archer $archer)
    {
        $this->archer = $archer;
    }

    public function isArcher()
    {
        return $this->archer != null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTokenPassword(): ?string
    {
        return $this->tokenPassword;
    }

    public function setTokenPassword(?string $tokenPassword): self
    {
        $this->tokenPassword = $tokenPassword;

        return $this;
    }

    public function getCreatedTokenPasswordAt(): ?\DateTimeInterface
    {
        return $this->createdTokenPasswordAt;
    }

    public function setCreatedTokenPasswordAt(?\DateTimeInterface $createdTokenPasswordAt): self
    {
        $this->createdTokenPasswordAt = $createdTokenPasswordAt;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function __ToString(): string
    {
        return $this->getUsername();
    }
}
