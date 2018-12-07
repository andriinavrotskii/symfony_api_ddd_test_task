<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 08.12.18
 * Time: 0:06
 */

namespace App\Domain\Model;

use App\Domain\ValueObject\Money;

interface SelectedProductInterface
{
    /**
     * @return Receipt
     */
    public function getReceipt(): Receipt;

    /**
     * @param Receipt $receipt
     */
    public function setReceipt(Receipt $receipt): void;

    /**
     * @return Product
     */
    public function getProduct(): Product;

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void;

    /**
     * @return Money
     */
    public function getCost(): Money;

    /**
     * @param Money $cost
     */
    public function setCost(Money $cost): void;

    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void;
}