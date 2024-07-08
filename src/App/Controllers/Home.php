<?php

namespace App\Controllers;

class Home
{
    public function index()
    {
        require_once (ROOT . '/views/home_index.php');
    }
}