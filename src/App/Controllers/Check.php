<?php

namespace Main\App\Controllers;

use Main\App\Models\Product;
use Main\Core\Controller;

class Check extends Controller
{
    //checkAction() is responsible for getting the "sku" values from the MySQL database
    //and encoding them in a json file, which later on gets
    //processed by Axios in Vue.js.
    public function checkAction(): void
    {
        $data = [];
        $post = new Product();
        $values = $post->query('SELECT sku FROM info');
        foreach ($values as $row) {
            $data[] = $row;
        }
        echo (count($values)) ? json_encode($data) : null;
    }
}
