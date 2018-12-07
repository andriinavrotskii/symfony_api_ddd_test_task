<?php

namespace App\Persistence\Repository;

use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{

}
