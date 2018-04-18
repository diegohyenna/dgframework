<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app;

use core\BaseController;

/**
 * Description of PostController
 *
 * @author diegohyenna
 */
class PostController extends BaseController
{
    public function __construct()
    {

    }
    
    public function index()
    {
        $this->renderView('home/index');
    }

    /**
     * @param int $id
     * @param null $request
     * @throws \Exception
     */
    public function show(int $id, $request = null)
    {
        $this->renderView('home/show', ['arroz' => 'feijao']);
    }
}
