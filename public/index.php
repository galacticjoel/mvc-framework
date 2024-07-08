<?php
	
	include ('../src/App/config/config.php');
	//use App\Controllers;
	//use Framework;
	
	$url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	
	
	spl_autoload_register(function (string $class_name) {
		
		require ROOT . "/src/" . str_replace("\\", "/", $class_name) . ".php";
		
	});
	
	$router = new Framework\Router;
	
	
	
	$router->add("/{controller}", '#^(?<controller>[a-z]+)$#iu');
	$router->add("/{controller}/{action}", '#^(?<controller>[a-zA-Z]+)\/(?<action>[a-zA-Z]+)$#iu');
	
	$router->add("/{controller}/{id}", '#^(?<controller>[a-zA-Z]+)\/(?<id>[0-9]+)$#iu'); 
	$router->add("/{controller}/{action}/{id}", '#^(?<controller>[a-zA-Z]+)\/(?<action>[a-zA-Z]+)\/(?<id>[0-9]+)$#iu'); 
	
	$router->add("/{controller}/{id}/{slug}", '#^(?<controller>[a-zA-Z]+)\/(?<id>[0-9]+)\/(?<slug>[a-zA-Z]+)$#iu');
	
	$router->add("/{controller}/{action}/{id}/{slug}", '#^(?<controller>[a-zA-Z]+)\/(?<action>[a-zA-Z]+)\/(?<id>[0-9]+)\/(?<slug>[a-zA-Z]+)$#iu'); 
	
	
	

	$router->dispatch($url_path);
	
	
					