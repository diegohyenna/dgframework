<?php
/**
 * Created by PhpStorm.
 * User: diegohyenna
 * Date: 11/04/2018
 * Time: 19:03
 */

namespace core;


class Route
{
    private $routes;

    /**
     * Route constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->setRoutes($routes);
        $this->run();
    }

    private function getUrl(): string
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    private function setRoutes($routes)
    {
        $r = [];

        foreach ($routes as $route)
        {
            $r = explode('@', $route[1]);

            $newRoute[] = [$route[0], $r[0], $r[1]];
        }
        
        $this->routes = $newRoute;
    }

    private function run()
    {
        $url = $this->getUrl();        

        foreach ($this->routes as $route)
        {
            $urlArray = explode('/', $url);

            array_shift($urlArray);

            $routeArray = $route[0];

            $routeArray = explode('/', $routeArray);

            array_shift($routeArray);

            if(count($urlArray) == count($routeArray))
            {
                for($i=0; $i<count($routeArray); $i++)
                {
                    if(strpos($routeArray[$i], ':') !== false)
                    {
                        $routeArray[$i] = $urlArray[$i];
                        $params[] = $routeArray[$i];
                    }                    
                }
                $routeArray = implode('/', $routeArray);

                $urlArray = implode('/', $urlArray);

                if($routeArray == $urlArray)
                {
                    $found = true;
                    $controller = $route[1];
                    $action = $route[2];
                    break;
                }
            }
        }
        
        if(isset($found) && $found)
        {
            $controller = Container::getController($controller);
            $request = $_GET;           
            
            switch (isset($params) && count($params))
            {
                case 1:
                    $controller->$action($params[0], $request);
                    break;
                case 2:
                    $controller->$action($params[0], $params[1], $request);
                    break;
                case 3:
                    $controller->$action($params[0], $params[1], $params[2], $request);
                    break;
                default:
                    $controller->$action($request);
                    break;
            }            
        }
        else
        {
            echo 'rota invalida';
        }
    }
}