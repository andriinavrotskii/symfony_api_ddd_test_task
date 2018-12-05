<?php

namespace App\Domain\Model;

use App\Domain\Exceptions\StatusException;
use Doctrine\Common\Collections\ArrayCollection;

class Receipt
{
    const STATUS_NEW = 0;

    const STATUS_FINISHED = 1;

    /** @var int */
    private $id;

    /** @var SelectedProduct[]|ArrayCollection */
    private $selectedProducts;

    /** @var integer */
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
     * @throws StatusException
     */
    public function addSelectedProduct(SelectedProduct $selectedProduct): void
    {
        if ($this->status == self::STATUS_FINISHED) {
            throw new StatusException("You can't add products to finished receipt");
        }
        $this->selectedProducts->add($selectedProduct);
        $selectedProduct->setReceipt($this);
    }

    /**
     * @param SelectedProduct $selectedProduct
     */
    public function removeSelectedProduct(SelectedProduct $selectedProduct): void
    {
        if (!$this->selectedProducts->contains($selectedProduct)) {
            return;
        }
        $this->selectedProducts->removeElement($selectedProduct);
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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @throws StatusException
     */
    public function setStatus(int $status): void
    {
        switch ($status) {
            case self::STATUS_NEW:
            case self::STATUS_FINISHED:
                $this->status = $status;
                break;
            default:
                throw new StatusException('Wrong Status value');
        }
    }

    public function __toString()
    {
        return "Receipt {$this->id} status {$this->status}";
    }
}
