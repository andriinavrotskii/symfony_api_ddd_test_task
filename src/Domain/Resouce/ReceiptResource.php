<?php

namespace App\Domain\Resouce;

class ReceiptResource
{
    private $id;
    private $status;
    private $selectedProducts;
    private $totalAmount;
    private $totalCost;

    /**
     * ReceiptResource constructor.
     * @param $id
     * @param $status
     * @param $selectedProducts
     * @param $totalAmount
     * @param $totalCost
     */
    public function __construct($id, $status, $selectedProducts, $totalAmount, $totalCost)
    {
        $this->id = $id;
        $this->status = $status;
        $this->selectedProducts = $selectedProducts;
        $this->totalAmount = $totalAmount;
        $this->totalCost = $totalCost;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getSelectedProducts()
    {
        return $this->selectedProducts;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @return mixed
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }


}