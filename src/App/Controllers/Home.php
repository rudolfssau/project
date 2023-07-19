<?php

namespace Main\App\Controllers;

use Exception;
use Main\Core\Controller;
use Main\Core\View;
use Main\App\Models\Product;

class Home extends Controller
{
    /**
     * @throws Exception
     */
    public function showAction(): void
    {
        View::render('Home/index.php');
    }
    public function deleteAction(): void
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['id'];
        $id = implode(',', $data);
        $delete = Product::delete("DELETE FROM info WHERE id IN($id)");
        $delete->execute();
    }
}
