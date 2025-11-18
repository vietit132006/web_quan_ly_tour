<?php

class HomeController {
    public function index() {
        echo "Đây là trang Home";
    }
}

class HomeController
{
    public function index() 
    {
        require_once PATH_VIEW . 'home.php';
    }
}

