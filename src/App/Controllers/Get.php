<?php

namespace Main\App\Controllers;

use Main\App\Models\Post;
use Main\Core\Controller;

class Get extends Controller
{
    public function returnJsonAction()
    {
        $data = [];
        try {
            $values = Post::query('SELECT * FROM info');
        } catch (\PDOException) {
            throw new \PDOException("Error with database connection");
        }
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
