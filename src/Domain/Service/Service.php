<?php

namespace App\Domain\Service;

use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReceiptRepositoryInterface;
use App\Domain\Repository\SelectedProductRepositoryInterface;

class Service
{
    /** @var ProductRepositoryInterface  */
    private $productRepository;

    /** @var ReceiptRepositoryInterface  */
    private $receiptRepository;

    /** @var SelectedProductRepositoryInterface  */
    private $selectedProductRepository;

    /**
     * Service constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param SelectedProductRepositoryInterface $selectedProductRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ReceiptRepositoryInterface $receiptRepository,
        SelectedProductRepositoryInterface $selectedProductRepository
    ) {
        $this->productRepository = $productRepository;
        $this->receiptRepository = $receiptRepository;
        $this->selectedProductRepository = $selectedProductRepository;
    }

    /**
     * @return \App\Domain\Model\Product[]
     */
    public function getReceipts()
    {
        return $this->productRepository->findAll();
    }


}