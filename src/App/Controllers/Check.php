<?php

namespace Main\App\Controllers;

use Main\App\Models\Post;
use Main\Core\Controller;

class Check extends Controller
{
    public function checkAction()
    {
        $data = [];
        $post = new Post();
        $values = $post->query('SELECT sku FROM info');
        foreach ($values as $row) {
            $data[] = $row;
        }
        echo (count($values)) ? json_encode($data) : null;
    }
}
