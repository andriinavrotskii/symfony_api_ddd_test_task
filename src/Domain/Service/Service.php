<?php

namespace App\Domain\Service;

use App\Domain\DataMapper\ReceiptToResourceMapper;
use App\Domain\Entity\Product;
use App\Domain\Entity\Receipt;
use App\Domain\Entity\SelectedProduct;
use App\Domain\Exceptions\ServiceException;
use App\Domain\Factory\ProductFactory;
use App\Domain\Factory\ReceiptFactory;
use App\Domain\Factory\SelectedProductFactory;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReceiptRepositoryInterface;
use App\Domain\Repository\SelectedProductRepositoryInterface;
use App\Domain\Request\AddProductToReceiptRequest;
use App\Domain\Request\ReceiptLastProductAmountUpdateRequest;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\BarcodeRequest;
use App\Domain\Request\ProductsListRequest;
use App\Domain\Request\ReceiptRequest;

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

    /** @var SelectedProductFactory */
    private $selectedProductFactory;

    /**
     * Service constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param SelectedProductRepositoryInterface $selectedProductRepository
     * @param ProductFactory $productFactory
     * @param ReceiptFactory $receiptFactory
     * @param SelectedProductFactory $selectedProductFactory
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ReceiptRepositoryInterface $receiptRepository,
        SelectedProductRepositoryInterface $selectedProductRepository,
        ProductFactory $productFactory,
        ReceiptFactory $receiptFactory,
        SelectedProductFactory $selectedProductFactory
    ) {
        $this->productRepository = $productRepository;
        $this->receiptRepository = $receiptRepository;
        $this->selectedProductRepository = $selectedProductRepository;
        $this->productFactory = $productFactory;
        $this->receiptFactory = $receiptFactory;
        $this->selectedProductFactory = $selectedProductFactory;
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
        $product = $this->productFactory->createProduct($request);
        $this->productRepository->persist($product);
        $this->productRepository->flush();

        return $product;
    }

    /**
     * @param BarcodeRequest $request
     * @return Product|null
     */
    public function getProductByBarcode(BarcodeRequest $request):? Product
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
     * @return \App\Domain\Entity\Receipt
     */
    public function createReceipt()
    {
        $receipt = $this->receiptFactory->create();
        $this->receiptRepository->persist($receipt);
        $this->receiptRepository->flush();

        return $receipt;
    }

    /**
     * @param AddProductToReceiptRequest $request
     * @throws ServiceException
     * @throws \App\Domain\Exceptions\StatusException
     */
    public function addProductToReceipt(AddProductToReceiptRequest $request)
    {
        $receipt = $this->findReceiptById($request->getReceiptId());
        $product = $this->findProductByBarcode($request->getBarcode());

        $selectedProduct = $this->selectedProductRepository->findOneBy([
            'product' => $product,
            'receipt' => $receipt
        ]);

        if (!$selectedProduct instanceof SelectedProduct) {
            $selectedProduct = $this->selectedProductFactory->create($receipt, $product, $request->getAmount());
            $receipt->addSelectedProduct($selectedProduct);
        } else {
            $selectedProduct->setAmount($request->getAmount());
        }

        $this->receiptRepository->persist($receipt);
        $this->receiptRepository->flush();
    }

    /**
     * @param ReceiptLastProductAmountUpdateRequest $request
     * @throws ServiceException
     */
    public function receiptLastProductAmountUpdate(ReceiptLastProductAmountUpdateRequest $request)
    {
        $receipt = $this->findReceiptById($request->getReceiptId());
        $this->checkIsRecetipOpen($receipt);
        /** @var SelectedProduct $selectedProduct */
        $selectedProduct = $receipt->getSelectedProducts()->last();
        $selectedProduct->setAmount($request->getAmount());

        $this->receiptRepository->persist($receipt);
        $this->receiptRepository->flush();
    }

    /**
     * @param int $receiptId
     * @return Receipt
     */
    private function findReceiptById(int $receiptId): Receipt
    {
        $receipt = $this->receiptRepository->find($receiptId);
        if (!$receipt instanceof Receipt) {
            $receipt = $this->receiptFactory->create();
        }
        return $receipt;
    }

    /**
     * @param Receipt $receipt
     * @throws ServiceException
     */
    private function checkIsRecetipOpen(Receipt $receipt)
    {
        if ($receipt->getStatus() === Receipt::STATUS_FINISHED) {
            throw new ServiceException("Receipt on FINISHED status");
        }
    }

    /**
     * @param string $barcode
     * @return Product
     * @throws ServiceException
     */
    private function findProductByBarcode(string $barcode): Product
    {
        $product = $this->productRepository->findOneBy(['barcode' => $barcode]);
        if (!$product instanceof Product) {
            throw new ServiceException('Product not found by barcode: ' . $barcode);
        }

        return $product;
    }

    /**
     * @param ReceiptRequest $request
     * @throws ServiceException
     * @throws \App\Domain\Exceptions\StatusException
     */
    public function finishReceipt(ReceiptRequest $request)
    {
        $receipt = $this->findReceiptById($request->getReceiptId());
        $this->checkIsRecetipOpen($receipt);
        $receipt->setStatus(Receipt::STATUS_FINISHED);

        $this->receiptRepository->persist($receipt);
        $this->receiptRepository->flush();
    }

    /**
     * @param ReceiptRequest $request
     * @return \App\Domain\Resource\ReceiptResource
     * @throws \App\Domain\Exceptions\MoneyException
     * @throws \App\Domain\Exceptions\StatusException
     */
    public function getReceiptReport(ReceiptRequest $request)
    {
        $mapper = new ReceiptToResourceMapper();

        $receipt = $this->findReceiptById($request->getReceiptId());
        return $mapper->map($receipt);
    }

}