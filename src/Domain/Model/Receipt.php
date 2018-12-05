<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Receipt
{
    const STATUS_NEW = 0;

    const STATUS_FINISHED = 1;

    /** @var int */
    private $id;

    /** @var SelectedProduct[]|ArrayCollection */
    private $selectedProducts;

    /** @var bool */
    private $status;

    /**
     * Receipt constructor.
     */
    public function __construct()
    {
        $this->selectedProducts = new ArrayCollection();
        $this->status = self::STATUS_NEW;
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
     * @param SelectedProduct $selectedProduct
     */
    public function addSelectedProduct(SelectedProduct $selectedProduct): void
    {
        $this->selectedProducts->add($selectedProduct);
    }

    /**
     * @return SelectedProduct|null
     */
    public function getLastSelectedProduct():? SelectedProduct
    {
        $element = $this->selectedProducts->last();
        if ($element) {
            return $element;
        }
        return null;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
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
