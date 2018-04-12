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

            array_push($r,[$route[0], $r[0], $r[1]]);
        }

        print_r($r);
        $this->routes = $r;
    }

    private function run()
    {
        $url = $this->getUrl();

        $urlArray = explode('/', $url);

        array_shift($urlArray);

        var_dump($urlArray);

        foreach ($this->routes as $route)
        {

            $routeArray = $route[0];

            print_r($routeArray);
            echo'<br>';

            $routeArray = explode('/', $routeArray);

            array_shift($routeArray);

            var_dump($routeArray);

            if(count($urlArray) == count($routeArray))
            {
                for($i=0; $i<count($routeArray); $i++)
                {
                    if(strpos($routeArray[$i], ':') !== false)
                    {
                        $routeArray[$i] = $urlArray[$i];
                    }
                }

                $routeArray = implode('/', $routeArray);

                $urlArray = implode('/', $urlArray);

                var_dump($routeArray);
                var_dump($urlArray);

                if($routeArray == $urlArray)
                {
                    echo 'igual';
                }
                else
                {
                    throw new \Exception("rota invalida!");
                }
            }
        }

    }
}