<?php

namespace Newsletter\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
}
