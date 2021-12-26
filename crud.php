<?php
include_once 'dbSettings.php';
include_once 'product.php';

abstract class crud extends dbSettings
{
    public function create($SKU, $productName, $productType, $price, $dimension1, $dimension2 = "NULL", $dimension3 = "NULL")
    {
        $conn = $this->connect();
        $product = new Product();
        $product->setSKU($SKU);
        $product->setProductName($productName);
        $product->setProductType($productType);
        $product->setPrice($price);
        $product->setDimension1($dimension1);
        $product->setDimension2($dimension2);
        $product->setDimension3($dimension3);
        $product->insert($conn);
        $conn->close();
    }
    public function read()
    {
        $product = new Product();
        $conn = $this->connect();
        $products = $product->getAll($conn);
        $productsList = array();
        if ($products == false) {
            return ("0 results");
        } else {
            foreach ($products as $product) {
                $productsList[] = array(
                'Id' => $product->getId(),
                'SKU' => $product->getSKU(),
                'productName' => $product->getProductName(),
                'productType' => $product->getProductType(),
                'price' => $product->getPrice(),
                'dimension1' => $product->getDimension1(),
                'dimension2' => $product->getDimension2(),
                'dimension3' => $product->getDimension3()
            );
            }
        }
        return json_encode($productsList);
    }
    public function delete($productIds)
    {
        $conn = $this->connect();
        $product = new Product();
        $product->delete($conn, $productIds);
    }
}
