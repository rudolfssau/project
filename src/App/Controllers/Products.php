<?php

namespace Main\App\Controllers;

session_start();

use Main\App\Models\Product;
use Main\Core\Controller;
use Main\Core\View;
use Main\Core\Error;

class Products extends Controller
{
    //MySQL duplicate entry code
    const IF_DUPLICATE_ENTRY = 1062;
    public function indexAction(): void
    {
        View::render("Products/index.php");
    }
    public function insertAction(): void
    {
        $error = false;
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sizemb = $_POST['sizemb'];
        $heightcm = $_POST['heightcm'];
        $widthcm = $_POST['widthcm'];
        $lengthcm = $_POST['lengthcm'];
        $weightkg = $_POST['weightkg'];
        $switcher = $_POST['switcher'];
        $main = array($sku, $name, $price, $switcher);
        $dvd = array($sizemb);
        $furniture = array($heightcm, $widthcm, $lengthcm);
        $book = array($weightkg);
        $data = [':sku' => $sku, ':name' => $name, ':price' => $price, ':sizemb' => $sizemb, ':heightcm' => $heightcm, ':widthcm' => $widthcm, ':lengthcm' => $lengthcm, ':weightkg' => $weightkg, ':switcher' => $switcher,];
        //Validation for input fields - checks if they are empty, checks for non-indicated type.
        foreach ($main as $item) {
            if (empty($item)) {
                $error = true;
            }
        }
        if ($switcher === 'none') {
            $error = true;
        }
        switch ($switcher) {
            //In case when "dvd" is selected
            case 'dvd':
                foreach ($dvd as $dataDvd) {
                    if (empty($dataDvd)) {
                        $error = true;
                    }
                }
                break;
            //In case when "furniture" is selected
            case 'furniture':
                foreach ($furniture as $dataFurniture) {
                    if (empty($dataFurniture)) {
                        $error = true;
                    }
                }
                break;
            //In case when "book" is selected
            case 'book':
                foreach ($book as $dataBook) {
                    if (empty($dataBook)) {
                        $error = true;
                    }
                }
                break;
        }
        try {
            if ($error) {
                http_response_code(500);
                throw new \PDOException("Please, fill out all of the required fields");
            } else {
                $sql = Product::insert("INSERT INTO info(sku, name, price, sizemb, heightcm, widthcm, lengthcm, weightkg, switcher) VALUES (:sku, :name, :price, :sizemb, :heightcm, :widthcm, :lengthcm, :weightkg, :switcher)");
                $sql->execute($data);
            }
        } catch (\PDOException $ex) {
            //Exception reporting to external log file.
            Error::exceptionHandler($ex);
            //Checks for MySQL duplicate by comparing error code to preset.
//            if ($ex->errorInfo[1] === self::IF_DUPLICATE_ENTRY) {
//                //Setting http response code to 500 and sending an error message to Vue via Axios.
//                http_response_code(500);
//                echo json_encode(array("message" => "SKU duplicate entry"));
//            } else {
//                echo json_encode(array("message" => $ex->getMessage()));
//            }
            echo json_encode(array("message" => $ex->getMessage()));
        }
    }
}
