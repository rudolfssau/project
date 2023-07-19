<?php

namespace Main\App\Controllers;

use Main\App\Models\Product;
use Main\Core\Controller;

class Get extends Controller
{
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
