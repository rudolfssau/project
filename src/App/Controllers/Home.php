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
    //showAction() is responsible for rendering the Home/index.php file with the help of the
    //View class located in src/Core.
    public function showAction(): void
    {
        View::render('Home/index.php');
    }
    //deleteAction() is responsible for the removal of select items from the MySQL database.
    //It gets the selected (checkbox checked) "id" values from the json file.
    //Finally, it deletes the specific record in the databased based on the selected item's "id".
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
