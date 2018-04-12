<?php

    $route = [
        ["/", "HomeController@index"],
        ["/posts", "PostController@index"],
        ["/posts/:id/show", "PostController@show"]
    ];

    return $route;