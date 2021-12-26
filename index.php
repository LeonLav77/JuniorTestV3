<?php

include_once 'crud.php';
class Router extends crud
{
    public function __construct()
    {
        $request = $_SERVER['REQUEST_URI'];
        switch ($request) {
            case preg_match('/\/product/', $request) ? true : false:
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->dimension2 = $_POST['dimension2'] ?? "NULL";
                    $this->dimension3 = $_POST['dimension3'] ?? "NULL";
                    $this->dimension2 = $this->dimension2 == "" ? "NULL" : $this->dimension2;
                    $this->dimension3 = $this->dimension3 == "" ? "NULL" : $this->dimension3;
                    $this->create($_POST['SKU'], $_POST['name'], $_POST['productType'], $_POST['price'], $_POST['dimension1'], $this->dimension2, $this->dimension3);
                    echo json_encode(array('status' => "success"));
                } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['checkedIds'])) {
                    if ($_GET['checkedIds'] != null) {
                        $this->delete(array($_GET['checkedIds']));
                        echo json_encode(explode(",", $_GET['checkedIds']));
                    } else {
                        echo "empty";
                    }
                } else {
                    $products = $this->read();
                    echo json_encode($products);
                }
                break;
            default:
                header("Location: /product");
                die();
        }
    }
}
$router = new Router();
