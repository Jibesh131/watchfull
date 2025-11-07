<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('route_details')){
    function route_details($route){
        $route = Route::getRoutes()->getByName($route);

        if ($route) {
            dd([
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'action' => $route->getActionName(),
                'middleware' => $route->middleware(),
            ]);
        }
    }
}