<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RouteManager
 *
 * @author Triophore-2
 */
class RouteManager {
    function __construct() {
        $base_url = getCurrentUri();
	$routes = array();
	$routes = explode('/', $base_url);
	foreach($routes as $route)
	{
		if(trim($route) != '')
			array_push($routes, $route);
	}
        return $routes;
    }
    
    private function getCurrentUri()
    {
            $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
            $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
            if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
            $uri = '/' . trim($uri, '/');
            return $uri;
    }
 
	
}
