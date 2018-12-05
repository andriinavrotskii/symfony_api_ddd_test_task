<?php

namespace App\Domain\Model;

class BaseEntity
{
    /** @var int */
    protected $id;

    /** @var \DateTime */
    protected $createdAt;

    /** @var \DateTime */
    protected $updatedAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setUpdatedAt(\DateTime $dateTime): void
    {
        $this->updatedAt = $dateTime;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt():? \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setCreatedAt(\DateTime $dateTime): void
    {
        $this->createdAt = $dateTime;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updateUpdatedAtNow()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }
}