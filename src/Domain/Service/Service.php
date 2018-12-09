<?php

namespace App\Domain\Service;

use App\Domain\Entity\ProductInterface;
use App\Domain\Entity\Receipt;
use App\Domain\Factory\ProductFactory;
use App\Domain\Factory\ReceiptFactory;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReceiptRepositoryInterface;
use App\Domain\Repository\SelectedProductRepositoryInterface;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\BarcodeRequest;
use App\Domain\Request\ProductsListRequest;

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

    /** @var ReceiptFactory */
    private $receiptFactory;

    /**
     * Service constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param SelectedProductRepositoryInterface $selectedProductRepository
     * @param ProductFactory $productFactory
     * @param ReceiptFactory $receiptFactory
     */
    public function __construct(ProductRepositoryInterface $productRepository, ReceiptRepositoryInterface $receiptRepository, SelectedProductRepositoryInterface $selectedProductRepository, ProductFactory $productFactory, ReceiptFactory $receiptFactory)
    {
        $this->productRepository = $productRepository;
        $this->receiptRepository = $receiptRepository;
        $this->selectedProductRepository = $selectedProductRepository;
        $this->productFactory = $productFactory;
        $this->receiptFactory = $receiptFactory;
    }

    /**
     * @return \App\Domain\Entity\Receipt[]
     */
    public function getReceipts()
    {
        return $this->receiptRepository->findAll();
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

    /**
     * @param BarcodeRequest $request
     * @return ProductInterface|null
     */
    public function getProductByBarcode(BarcodeRequest $request):? ProductInterface
    {
        return $this->productRepository->findOneBy(['barcode' => $request->getBarcode()]);
    }

    /**
     * @param ProductsListRequest $request
     * @return mixed
     */
    public function getProductsList(ProductsListRequest $request)
    {
        return $this->productRepository->findBy(
            [],
            $request->getOrderBy(),
            $request->getLimit(),
            $request->getOffset()
        );
    }

    /**
     * @return \App\Domain\Entity\ReceiptInterface
     */
    public function createReceipt()
    {
        $receipt = $this->receiptFactory->create();
        $this->receiptRepository->save($receipt);

        return $receipt;
    }
}