<?php

declare(strict_types=1);

namespace HydratorWorkshop;

use DateTime;

class User
{
    private $id = '';

    private $username = '';

    private $acl = [];

    /**
     * @var Profile
     */
    private $profile;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return array
     */
    public function getAcl(): array
    {
        return $this->acl;
    }

    /**
     * @param array $acl
     */
    public function setAcl(array $acl): void
    {
        $this->acl = $acl;
    }

    /**
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function exchangeArray($data): void
    {
        $this->id = $data['id'];
        $this->profile = $data['profile'];
        $this->username = $data['username'];
        $this->acl = $data['acl'];
        $this->createdAt = $data['createdAt'];
        $this->updatedAt = $data['updatedAt'];
    }

    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'profile' => $this->profile->getArrayCopy(),
            'username' => $this->username,
            'acl' => $this->acl,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
