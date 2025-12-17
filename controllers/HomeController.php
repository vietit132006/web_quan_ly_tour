<?php
class HomeController
{
    public function index()
    {
        require_once './models/TourModel.php';
        $tourModel = new TourModel();
        $tours = $tourModel->getAllTours();

        // Gán biến view
        $view = __DIR__ . '/../views/home.php';

        // Include layout master
        include __DIR__ . '/../views/layout/admin/master.php';
    }
}
