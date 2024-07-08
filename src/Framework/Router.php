<?php
	
	namespace Framework;
	
	class Router
	{
		private array $routes = [];
		private string $matchResult = 'false';
		
		private string $controller;
		private string $action;
		
		
		
		public function add(string $path, string $regex): void
		{
			$this->routes[] = [
            "path" => $path,
            "regex" => $regex
			];
		}
		
		
		private function match(string $url_path): void
		{
			
			$url_path = trim($url_path, '/');
			
			$url_path = str_replace('-', '',  ucwords( strtolower($url_path), '-' ) );
			
			
			
			foreach ($this->routes as $route) {
				
				$pattern = $route['regex'];  
				
				
				
				if ( !preg_match($pattern, $url_path) ) {
					
					continue;
					
					
					}  else {
					
					$this->matchResult = 'true';
					
					
				}
				
				
			}
			
		}
		
		
		public function dispatch(string $url_path):  void
		{
			
			
			$this->match($url_path);
			
			if( $this->matchResult == 'true' )  {
				
				$url_path = urldecode($url_path);
				
				if($url_path != '/') {
					$url_path = trim($url_path, "/");
				}
				
				$url_path = str_replace('-', '',  ucwords( strtolower($url_path), '-' ) );
				
				
				
				if($url_path == '/'){
					
					$home = new \App\Controllers\Home;
					$home->index();
					exit;   //call_user_func_array();
					
				}
				
				foreach ($this->routes as $route) {
					
					$pattern = $route['regex'];   
					
					
					if ( preg_match($pattern, $url_path, $matches) ) {   
						
						//echo '<pre>'; print_r($matches); echo '</pre>';
						
						$matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
						
						//echo '<pre>'; print_r($matches); echo '</pre>';  
						
						if( ! file_exists( APPROOT . "/Controllers/" . ucwords($matches['controller']) . '.php' ) ) {
							
							$home = new \App\Controllers\Home;
							$home->index();
							exit;  //call_user_func_array();
							
							
						}  
						
						
						if( file_exists( APPROOT . "/Controllers/" . ucwords($matches['controller']) . '.php' ) ) {
							
							
							
							$this->controller = "App\Controllers\\" . $matches['controller'];
							
							
							if( empty($matches['action']) ) {
								
								$params = array_filter($matches, function ($key) {
									
									return $key !== 'controller' && $key !== 'action';
									
								}, ARRAY_FILTER_USE_KEY);
								
								//echo '<pre>'; print_r($params); echo '</pre>';
								
								
								
								if( count($params)>0 ) {
									
									$object = new $this->controller;
									
									$object->index(...$params);
									
									exit;
									
									} else {
									
									
									$object = new $this->controller;                         
									$object->index();
									
									exit;
									
								}
								
								
								
								
							}   
							
							if( !method_exists($this->controller, $matches['action']) ) {
								
								$home = new \App\Controllers\Home;
								$home->index();
								
								exit;
								
								
							}  
							
							
							if( method_exists($this->controller, $matches['action']) ) {
								
								
								$this->action = strtolower( $matches['action'] );
								
								$params = array_filter($matches, function ($key) {
									
									
									return $key !== 'controller' && $key !== 'action';
									
								}, ARRAY_FILTER_USE_KEY);
								
								//echo '<pre>'; print_r($params); echo '</pre>';
								
								
								if( count($params)>0 ) {
									
									$object = new $this->controller;
									$action = $this->action;
									
									$object->$action(...$params);
									
									exit;
									
									} else {
									
									
									$object = new $this->controller;
									$action = $matches['action'];
									$object->$action();
									
									exit;
									
								}
								
								
								
								
								
								
							} // end if(method_exists)
							
							
							
							
							
						} // end if(class_exists)
						
						
						
					} // end if(preg_match)
					
				} // end foreach
				
				
				} else {
				
				
				$home = new \App\Controllers\Home;
				$home->index();
				
				exit;
				
				
			}    
			
			
		} // end dispatch()
		
		
		
		
		
	} // end class Router
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
