<?php

namespace Main\App\Controllers;

use Main\Core\Controller;
use Main\Core\View;
use Main\App\Models\Post;

class Home extends Controller
{
    public function showAction(): void
    {
        View::render('Home/index.php');
    }
    public function deleteAction(): void
    {
        $post = new Post();
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = $data['id'];
        $id = implode(',', $data);
        $delete = $post->delete("DELETE FROM info WHERE id IN($id)");
        $delete->execute();
    }
    public function testAction(): void
    {
        $post = new Router();
        $post->add('/home/delete', ['controller' => 'Home', 'action' => 'delete']);
        $postRoute = $post->returnVal();
        print_r($postRoute);
    }
}
