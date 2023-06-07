<?php

namespace Main\App\Controllers;

use Main\App\Models\Post;
use Main\Core\Controller;

class Get extends Controller
{
    public function returnJsonAction()
    {
        $data = [];
        $post = new Post();
        $values = $post->query('SELECT * FROM info');
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
