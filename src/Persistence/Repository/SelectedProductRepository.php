<?php

namespace App\Persistence\Repository;

use App\Domain\Repository\SelectedProductRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class SelectedProductRepository extends EntityRepository implements SelectedProductRepositoryInterface
{

}
