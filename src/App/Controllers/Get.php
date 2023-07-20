<?php

namespace Main\App\Controllers;

use Main\App\Models\Product;
use Main\Core\Controller;

class Get extends Controller
{
    //returnJsonAction() is responsible for gathering all MySQL database
    //records and parsing them inside a json file, which later on gets
    //processed by Axios in Vue.js
    public function returnJsonAction(): void
    {
        $data = [];
        $values = Product::query('SELECT * FROM info');
        if (!$values) {
            return;
        } else {
            foreach ($values as $row) {
                $data[] = $row;
            }
        }
        echo json_encode($data);
    }
}
