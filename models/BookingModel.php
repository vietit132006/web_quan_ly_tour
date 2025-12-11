<?php
require_once __DIR__ . '/BaseModel.php';

<<<<<<< HEAD
class BookingModel extends DB
=======
class BookingModel extends BaseModel
>>>>>>> master
{
    protected $table = 'booking';

    public function getAll()
    {
        $sql = "
            SELECT b.*, t.name AS tour_name
            FROM booking b
            LEFT JOIN tours t ON b.tour_id = t.id
            ORDER BY b.id DESC
        ";
        return $this->query($sql)->fetchAll();
<<<<<<< HEAD
    }

    public function findById($id)
    {
        $sql = "
            SELECT b.*, t.name AS tour_name
            FROM booking b
            LEFT JOIN tours t ON b.tour_id = t.id
            WHERE b.id = ?
        ";
        return $this->query($sql, [$id])->fetch();
    }

    public function updateStatus($id, $status, $note = null)
    {
        $sql = "
            UPDATE booking
            SET status = ?, admin_note = ?
            WHERE id = ?
        ";
        $this->execute($sql, [$status, $note, $id]);
    }
}
=======
    }

    public function findById($id)
    {
        $sql = "
            SELECT b.*, t.name AS tour_name
            FROM booking b
            LEFT JOIN tours t ON b.tour_id = t.id
            WHERE b.id = ?
        ";
        return $this->query($sql, [$id])->fetch();
    }

    public function updateStatus($id, $status, $note = null)
    {
        $sql = "
            UPDATE booking
            SET status = ?, admin_note = ?
            WHERE id = ?
        ";
        $this->execute($sql, [$status, $note, $id]);
    }
}
>>>>>>> master
