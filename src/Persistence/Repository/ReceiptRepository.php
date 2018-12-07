<?php

namespace App\Persistence\Repository;

use App\Domain\Repository\ReceiptRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class ReceiptRepository extends EntityRepository implements ReceiptRepositoryInterface
{

}
