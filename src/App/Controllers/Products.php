<?php

namespace Main\App\Controllers;

session_start();

use Main\App\Models\Post;
use Main\Core\Controller;
use Main\Core\View;
use Main\Core\Error;

class Products extends Controller
{
    const IF_DUPLICATE_ENTRY = 1062;
    public function indexAction(): void
    {
        View::render("Products/index.php");
    }
    public function insertAction(): void
    {
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sizemb = $_POST['sizemb'];
        $heightcm = $_POST['heightcm'];
        $widthcm = $_POST['widthcm'];
        $lengthcm = $_POST['lengthcm'];
        $weightkg = $_POST['weightkg'];
        $switcher = $_POST['switcher'];
        $data = [':sku' => $sku, ':name' => $name, ':price' => $price, ':sizemb' => $sizemb, ':heightcm' => $heightcm, ':widthcm' => $widthcm, ':lengthcm' => $lengthcm, ':weightkg' => $weightkg, ':switcher' => $switcher,];
        try {
            $sql = Post::insert("INSERT INTO info(sku, name, price, sizemb, heightcm, widthcm, lengthcm, weightkg, switcher) VALUES (:sku, :name, :price, :sizemb, :heightcm, :widthcm, :lengthcm, :weightkg, :switcher)");
            $sql->execute($data);
        } catch (\PDOException $ex) {
            Error::exceptionHandler($ex);
            if ($ex->errorInfo[1] === self::IF_DUPLICATE_ENTRY) {
                http_response_code(500);
                echo json_encode(array("message" => "Duplicate entry"));
            }
        }
    }
}
