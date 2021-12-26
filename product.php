<?php
class Product{
    private $sku;
    private $productName;
    private $productType;
    private $price;
    private $dimension1;
    private $dimension2;
    private $dimension3;
    private $id;
    public function insert($conn){
        $sql = "INSERT INTO products (SKU, productName,productType, price, dimension1, dimension2, dimension3) VALUES ('$this->sku', '$this->productName','$this->productType', $this->price, $this->dimension1, $this->dimension2, $this->dimension3)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    public function getAll($conn){
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $products = array();
            while($row = $result->fetch_assoc()) {
                $products[$row['id']] = new Product();
                $products[$row['id']]->setId($row['id']);
                $products[$row['id']]->setSKU($row['SKU']);
                $products[$row['id']]->setProductName($row['productName']);
                $products[$row['id']]->setProductType($row['productType']);
                $products[$row['id']]->setPrice($row['price']);
                $products[$row['id']]->setDimension1($row['dimension1']);
                $products[$row['id']]->setDimension2($row['dimension2']);
                $products[$row['id']]->setDimension3($row['dimension3']);
            }
            return $products;
        } else {
            return false;
        }
    }
    public function delete($conn, $productIds){
        $sql = "DELETE FROM products WHERE id IN (" . implode(',', $productIds) . ")";
        $conn->query($sql);
        $conn->close();
    }
    public function setSKU($SKU) {
        $this->sku = $SKU;
    }
    public function setProductName($productName) {
        $this->productName = $productName;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setDimension1($dimension1) {
        $this->dimension1 = $dimension1;
    }
    public function setDimension2($dimension2) {
        $this->dimension2 = $dimension2;
    }
    public function setDimension3($dimension3) {
        $this->dimension3 = $dimension3;
    }
    public function getSKU() {
        return $this->sku;
    }
    public function getProductName() {
        return $this->productName;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getDimension1() {
        return $this->dimension1;
    }
    public function getDimension2() {
        return $this->dimension2;
    }
    public function getDimension3() {
        return $this->dimension3;
    }
    public function setProductType($productType) {
        $this->productType = $productType;
    }
    public function getProductType() {
        return $this->productType;
    }
    public function setId($id){
        return $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
}

