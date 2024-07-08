<?php

namespace App\Controllers;

class TestClass
{
    public function index()
    {
	$a = ['Title 111', 'Title 222', 'Title 333'];
        require_once(ROOT . '/views/test.php');
    }
}