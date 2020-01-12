<?php

namespace App\Exception;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AccountDeletedException extends AccountStatusException
{
    private $user;
    /**
     * Get the user.
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * {@inheritdoc}
     */
    public function __serialize(): array
    {
        return [$this->user, parent::__serialize()];
    }
    /**
     * {@inheritdoc}
     */
    public function __unserialize(array $data): void
    {
        [$this->user, $parentData] = $data;
        parent::__unserialize($parentData);
    }
}