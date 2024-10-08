<?php

class indexController extends Controller
{
    private $_index;

    function __construct()
    {
        parent::__construct();
        $this->_index = $this->loadModel('index');

    }

    public function index()
    {
        
        $this->_view->renderizar('index');
        }
    }