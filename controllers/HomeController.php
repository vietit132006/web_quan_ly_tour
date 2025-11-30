<?php
class HomeController
{
    public function index() 
    {
          require_once './models/TourModel.php';
        $tourModel = new TourModel();
        $tours = $tourModel->getAllTours();

        require_once PATH_VIEW . 'home.php';
    }
}

