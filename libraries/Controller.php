<?php

namespace App\Controllers;

class Controller
{
	
	  public function model($model)
    {
        require_once "src/App/Models" .$model. ".php";
    }
	
	
    public function view($view)
    {
	
	
        require_once "views/" .$view. ".php";
    }
}