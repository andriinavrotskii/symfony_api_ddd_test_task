<?php

namespace App\Domain\Entity;

interface AbstractEntityInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @param \DateTime $dateTime
     */
    public function setUpdatedAt(\DateTime $dateTime): void;

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function setCreatedAt(\DateTime $dateTime): void;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    public function updateUpdatedAtNow();
}