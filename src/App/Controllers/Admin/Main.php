<?php

namespace App\Controllers\Admin;

class Main
{
    public function index()
    {
        require_once (ROOT . '/views/admin_main_index.php');
    }
}