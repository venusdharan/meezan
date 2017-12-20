<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimpleRouter
 *
 * @author Triophore-2
 */
class SimpleRouter {
  
    var $routes_end = array();
    function __construct() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
              // $uri_temp = explode("#", $uri);
              // $uri  = $uri_temp[0];
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		
        $base_url = '/' . trim($uri, '/');
	$routes = array();
       //'/' .
        
	$routes = explode('/', $base_url);
       
	foreach($routes as $route)
	{
		if(trim($route) != '' AND $route != '/')
                {
                    array_push($this->routes_end, $route);
                }
			
	}
        //$this->routes = $routes;
    }
    public function get_all_routes_aparm()
    {
        
       // var_dump($this->routes_end);
        return $this->routes_end;
      //  $index_for_module = array_search('#', $this->routes_end);
      //  return  $route_without_module = array_chunk($this->routes_end,$index_for_module);
    }
   
	
}
?>