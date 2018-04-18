<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

/**
 * Description of Container
 *
 * @author diegohyenna
 */
abstract class Container 
{
    /**
     * 
     * @param type $controller
     * @return type
     */
    public function getController(string $controller)
    {
        if(require_once __DIR__ . '/../app/controllers/' . $controller .'.php')
        {   
            $path = "\\app\\" . $controller;                      
            return new $path;            
        }
    }
}
