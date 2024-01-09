<?php

// Ke thua tu class Model
class DashboardModel extends Model
{
    protected $table = '';

    public function getAllProduct()
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
