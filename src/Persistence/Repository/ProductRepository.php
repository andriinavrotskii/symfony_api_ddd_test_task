<?php

namespace App\Persistence\Repository;

use App\Domain\Model\ProductInterface;
use App\Domain\Repository\ProductRepositoryInterface;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    /**
     * @param ProductInterface $product
     * @return ProductInterface|mixed
     */
    public function save(ProductInterface $product)
    {
        $this->em->persist($product);
        $this->em->flush();
        return $product;
    }
}
