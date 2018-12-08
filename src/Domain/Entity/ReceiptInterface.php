<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 08.12.18
 * Time: 0:05
 */

namespace App\Domain\Entity;

use App\Domain\Exceptions\StatusException;
use Doctrine\Common\Collections\ArrayCollection;

interface ReceiptInterface
{
    const STATUS_NEW = 0;

    const STATUS_FINISHED = 1;

    /**
     * @return SelectedProduct[]|ArrayCollection
     */
    public function getSelectedProducts();

    /**
     * @param SelectedProduct[]|ArrayCollection $selectedProducts
     */
    public function setSelectedProducts($selectedProducts): void;

    /**
     * @param SelectedProduct $selectedProduct
     * @throws StatusException
     */
    public function addSelectedProduct(SelectedProduct $selectedProduct): void;

    /**
     * @param SelectedProduct $selectedProduct
     * @throws StatusException
     */
    public function removeSelectedProduct(SelectedProduct $selectedProduct): void;

    /**
     * @return SelectedProduct|null
     */
    public function getLastSelectedProduct(): ?SelectedProduct;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     * @throws StatusException
     */
    public function setStatus(int $status): void;
}