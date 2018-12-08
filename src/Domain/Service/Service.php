<?php

namespace App\Domain\Service;

use App\Domain\Factory\ProductFactory;
use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReceiptRepositoryInterface;
use App\Domain\Repository\SelectedProductRepositoryInterface;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\BarcodeRequest;

class Service
{
    /** @var ProductRepositoryInterface  */
    private $productRepository;

    /** @var ReceiptRepositoryInterface  */
    private $receiptRepository;

    /** @var SelectedProductRepositoryInterface  */
    private $selectedProductRepository;

    /** @var ProductFactory */
    private $productFactory;

    /**
     * Service constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param SelectedProductRepositoryInterface $selectedProductRepository
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductRepositoryInterface $productRepository, ReceiptRepositoryInterface $receiptRepository, SelectedProductRepositoryInterface $selectedProductRepository, ProductFactory $productFactory)
    {
        $this->productRepository = $productRepository;
        $this->receiptRepository = $receiptRepository;
        $this->selectedProductRepository = $selectedProductRepository;
        $this->productFactory = $productFactory;
    }

    /**
     * @return \App\Domain\Model\Product[]
     */
    public function getReceipts()
    {
        return $this->productRepository->findAll();
    }

    /**
     * @param CreateProductRequest $request
     * @return mixed
     * @throws \App\Domain\Exceptions\MoneyException
     * @throws \App\Domain\Exceptions\VatException
     */
    public function createProduct(CreateProductRequest $request)
    {
        return $this->productRepository->save(
            $this->productFactory->createProduct($request)
        );
    }

    public function getProductByBarcode(BarcodeRequest $request)
    {
        return $this->productRepository->findOneBy(['barcode' => $request->getBarcode()]);
    }

}