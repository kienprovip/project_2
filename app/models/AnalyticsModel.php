<?php

// Ke thua tu class Model
class AnalyticsModel extends Model
{
    protected $table = '';

    public function getAnalytics($month)
    {
        $currentTime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $year = $currentTime->format('Y');
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE MONTH(delivery_date) = $month AND YEAR(delivery_date) = $year")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
