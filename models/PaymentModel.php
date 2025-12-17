<?php

class PaymentModel extends BaseModel
{
    protected $table = 'payments';

    // =========================
    // TẠO PAYMENT KHI TẠO BOOKING
    // =========================
    public function create($data)
    {
        $sql = "
        INSERT INTO payments
        (booking_id, amount, method, status, note)
        VALUES (?, ?, ?, ?, ?)
        ";

        return $this->execute($sql, [
            $data['booking_id'],
            $data['amount'],
            $data['method'],
            $data['status'] ?? 'unpaid',
            $data['note'] ?? null
        ]);
    }

    public function getByBooking($bookingId)
    {
        $sql = "SELECT * FROM payments WHERE booking_id = ? LIMIT 1";
        return $this->query($sql, [$bookingId])->fetch();
    }
    // =========================
    // ĐÁNH DẤU ĐÃ THANH TOÁN
    // =========================
    public function markPaid($bookingId, $note = null)
    {
        $sql = "
            UPDATE payments
            SET status = 'paid',
                paid_at = NOW(),
                note = ?
            WHERE booking_id = ?
        ";

        return $this->execute($sql, [$note, $bookingId]);
    }

    // =========================
    // THANH TOÁN THẤT BẠI
    // =========================
    public function markFailed($bookingId, $note = null)
    {
        $sql = "
            UPDATE payments
            SET status = 'failed',
                note = ?
            WHERE booking_id = ?
        ";

        return $this->execute($sql, [$note, $bookingId]);
    }

    // =========================
    // HOÀN TIỀN
    // =========================
    public function markRefunded($bookingId, $note = null)
    {
        $sql = "
            UPDATE payments
            SET status = 'refunded',
                note = ?
            WHERE booking_id = ?
        ";

        return $this->execute($sql, [$note, $bookingId]);
    }
}
