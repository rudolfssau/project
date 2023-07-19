<?php

namespace Main\App\Controllers;

session_start();

use Main\App\Models\Product;
use Main\Core\Controller;
use Main\Core\View;
use Main\Core\Error;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\Console\Exception\MissingInputException;

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
        $isNumeric = false;
        $empty = false;
        $sku = filter_var($_POST['sku'], FILTER_SANITIZE_NUMBER_INT);
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
        $sizemb = filter_var($_POST['sizemb'], FILTER_SANITIZE_NUMBER_INT);
        $heightcm = filter_var($_POST['heightcm'], FILTER_SANITIZE_NUMBER_INT);
        $widthcm = filter_var($_POST['widthcm'], FILTER_SANITIZE_NUMBER_INT);
        $lengthcm = filter_var($_POST['lengthcm'], FILTER_SANITIZE_NUMBER_INT);
        $weightkg = filter_var($_POST['weightkg'], FILTER_SANITIZE_NUMBER_INT);
        $switcher = $_POST['switcher'];
        $main = array($sku, $name, $price, $switcher);
        $dvd = array($sizemb);
        $furniture = array($heightcm, $widthcm, $lengthcm);
        $book = array($weightkg);
        $data = [':sku' => $sku, ':name' => $name, ':price' => $price, ':sizemb' => $sizemb, ':heightcm' => $heightcm, ':widthcm' => $widthcm, ':lengthcm' => $lengthcm, ':weightkg' => $weightkg, ':switcher' => $switcher,];
        //Validation for input fields - checks if they are empty, checks for non-indicated type.
        foreach ($main as $item) {
            if (empty($item)) {
                $empty = true;
            }
        }
        if ($switcher === 'none') {
            $empty = true;
        }
        if (is_numeric($price)) {
            $isNumeric = true;
        }
        switch ($switcher) {
            //In case when "dvd" is selected
            case 'dvd':
                foreach ($dvd as $dataDvd) {
                    //Checks if input fields are either empty of filled.
                    if (empty($dataDvd)) {
                        $empty = true;
                        //Checks if input field data is numeric.
                    } else if (filter_var($dataDvd, FILTER_VALIDATE_INT)) {
                        $isNumeric = true;
                    }
                }
                break;
            //In case when "furniture" is selected
            case 'furniture':
                foreach ($furniture as $dataFurniture) {
                    //Checks if input fields are either empty of filled.
                    if (empty($dataFurniture)) {
                        $empty = true;
                        //Checks if input field data is numeric.
                    } else if (filter_var($dataFurniture, FILTER_VALIDATE_INT)) {
                        $isNumeric = true;
                    }
                }
                break;
            //In case when "book" is selected
            case 'book':
                foreach ($book as $dataBook) {
                    //Checks if input fields are either empty of filled.
                    if (empty($dataBook)) {
                        $empty = true;
                        //Checks if input field data is numeric.
                    } else if (filter_var($dataBook, FILTER_VALIDATE_INT)) {
                        $isNumeric = true;
                    }
                }
                break;
        }
        try {
            //Validation for input fields.
            if ($empty) {
                http_response_code(500);
                throw new MissingInputException("Please, fill out all of the required fields");
                //Checks if values are numeric.
            } else if (!$isNumeric) {
                http_response_code(500);
                throw new InvalidArgumentException("Please, provide the data of indicated type");
            } else {
                $sql = Product::insert("INSERT INTO info(sku, name, price, sizemb, heightcm, widthcm, lengthcm, weightkg, switcher) VALUES (:sku, :name, :price, :sizemb, :heightcm, :widthcm, :lengthcm, :weightkg, :switcher)");
                $sql->execute($data);
            }

        } catch (\PDOException $ex) {
            //Exception reporting to external log file.
            Error::exceptionHandler($ex);
            //Checks for MySQL duplicate by comparing error code to preset.
            if ($ex->errorInfo[1] === self::IF_DUPLICATE_ENTRY) {
                //Setting http response code to 500 and sending an error message to Vue via Axios.
                http_response_code(500);
                echo json_encode(array("message" => "SKU duplicate entry"));
            }
            //Empty input field check.
        } catch (MissingInputException|\InvalidArgumentException $ex) {
            echo json_encode(array("message" => $ex->getMessage()));
        }
    }
}
