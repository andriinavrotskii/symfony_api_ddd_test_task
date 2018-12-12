<?php

namespace App\Domain\Resouce;

class SelectedProductResource
{
    private $id;
    private $barcode;
    private $name;
    private $amount;
    private $cost;
    private $totalCost;

    /**
     * SelectedProductResource constructor.
     * @param $id
     * @param $barcode
     * @param $name
     * @param $amount
     * @param $cost
     * @param $totalCost
     */
    public function __construct($id, $barcode, $name, $amount, $cost, $totalCost)
    {
        $this->id = $id;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->amount = $amount;
        $this->cost = $cost;
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
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }


}
