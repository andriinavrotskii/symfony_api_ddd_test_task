<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Receipt
{
    /** @var int */
    private $id;

    /** @var SelectedProduct[]|ArrayCollection */
    private $selectedProducts;

    /** @var bool */
    private $status;

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
     * @return SelectedProduct[]|ArrayCollection
     */
    public function getSelectedProducts()
    {
        return $this->selectedProducts;
    }

    /**
     * @param SelectedProduct[]|ArrayCollection $selectedProducts
     */
    public function setSelectedProducts($selectedProducts): void
    {
        $this->selectedProducts = $selectedProducts;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
