<?php

// Ke thua tu class Model
class HomeModel extends Model
{
    protected $table = '';

    public function getCategory()
    {
        $this->table = 'categories';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getFeatureProduct()
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1  ORDER BY (product_sold) DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getFlashSales()
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1 ORDER BY (product_discount_percent) DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
