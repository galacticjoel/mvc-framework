<?php

namespace App\Controllers;

class Test
{
    public function index()
    {
	$a = ['Title 111', 'Title 222', 'Title 333'];
        require_once (ROOT . 'views/test.php');
    }
}