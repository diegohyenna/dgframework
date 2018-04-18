<?php
/**
 * Created by PhpStorm.
 * User: diegohyenna
 * Date: 18/04/2018
 * Time: 19:35
 */

namespace core;


class BaseController
{
    public function renderView(string $path, $data = null)
    {
        if(file_exists(__DIR__ . '/../app/views/'. $path .'.phtml') )
        {
            require_once __DIR__ . '/../app/views/'. $path .'.phtml';
        }
        else
        {
            throw new \Exception('A view não pode ser encontrada');
        }
    }
}