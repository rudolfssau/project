<?php

namespace Main\App\Controllers;

session_start();

use Main\App\Models\Post;
use Main\Core\Controller;
use Main\Core\View;

class Posts extends Controller
{
    public function indexAction(): void
    {
        View::render("Posts/index.php");
    }
    public function insertAction(): void
    {
        $post = new Post();
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sizemb = $_POST['sizemb'];
        $heightcm = $_POST['heightcm'];
        $widthcm = $_POST['widthcm'];
        $lengthcm = $_POST['lengthcm'];
        $weightkg = $_POST['weightkg'];
        $switcher = $_POST['switcher'];
        $data = [
            ':sku' => $sku,
            ':name' => $name,
            ':price' => $price,
            ':sizemb' => $sizemb,
            ':heightcm' => $heightcm,
            ':widthcm' => $widthcm,
            ':lengthcm' => $lengthcm,
            ':weightkg' => $weightkg,
            ':switcher' => $switcher,
        ];
        try {
            $sql = $post->insert("INSERT INTO info(sku, name, price, sizemb, heightcm, widthcm, lengthcm, weightkg, switcher) VALUES (:sku, :name, :price, :sizemb, :heightcm, :widthcm, :lengthcm, :weightkg, :switcher)");
            $sql->execute($data);
            header('Location:/');
        } catch (\PDOException $ex) {
            return;
        }
    }
}
