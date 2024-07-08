<?php

namespace App\Controllers;

class IdController
{
    public function index($id)
    {
	$id1 = $id;
        require_once (ROOT . '/views/id_index.php');
    }
}