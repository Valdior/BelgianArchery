<?php

namespace App\Entity;

use App\Entity\Archer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @ORM\Table(name="_user")
 * @
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
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenRegistration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tokenValidateOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tokenPasswordValidateOn;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->enabled = false;
        
    }

    /**
     * @ORM\PrePersist
     */
    public function createDate()
    {
        $this->createdOn = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->modifiedOn = new \DateTime();
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

    public function getTokenRegistration(): ?string
    {
        return $this->tokenRegistration;
    }

    public function setTokenRegistration(?string $tokenRegistration): self
    {
        $this->tokenRegistration = $tokenRegistration;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getTokenValidateOn(): ?\DateTimeInterface
    {
        return $this->tokenValidateOn;
    }

    public function setTokenValidateOn(?\DateTimeInterface $tokenValidateOn): self
    {
        $this->tokenValidateOn = $tokenValidateOn;

        return $this;
    }

    public function getTokenPasswordValidateOn(): ?\DateTimeInterface
    {
        return $this->tokenPasswordValidateOn;
    }

    public function setTokenPasswordValidateOn(?\DateTimeInterface $tokenPasswordValidateOn): self
    {
        $this->tokenPasswordValidateOn = $tokenPasswordValidateOn;

        return $this;
    }
}
