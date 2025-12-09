<?php
require_once __DIR__ . '/../models/BookingModel.php';

class BookingController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BookingModel();
    }

    public function index()
    {
        $bookings = $this->model->getAll();
        require_once __DIR__ . '/../views/Booking/booking.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=booking");
            exit;
        }

        $booking = $this->model->findById($id);
        require_once __DIR__ . '/../views/Booking/booking_view.php';
    }

    public function updateStatus()
    {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if (!$id || !$status) {
            header("Location: index.php?action=booking");
            exit;
        }

        $this->model->updateStatus($id, $status, null);

        header("Location: index.php?action=booking");
        exit;
    }
}
