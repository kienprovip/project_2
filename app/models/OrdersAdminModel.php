<?php
class OrdersAdminModel extends Model
{
    protected $table = '';
    public function getNewOrders()
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getListOrdersCondition($id)
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function incomeFluctuationsMonthAgo()
    {
        $currentTime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dateTime = $currentTime->format('m');
        $this->table = 'orders';
        $condition = "";

        if ($dateTime == 1) {
            $condition = "WHERE YEAR(delivery_date) = " . ($currentTime->format('Y') - 1) . " AND MONTH(delivery_date) = 12";
        } else {
            $condition = "WHERE MONTH(delivery_date) = " . ($dateTime - 1);
        }

        $data = $this->db->query("SELECT * FROM $this->table $condition")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function incomeFluctuationsMonthCurrent()
    {
        $currentTime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dateTime = $currentTime->format('m');
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE MONTH(delivery_date) = $dateTime")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getListOrderStatus($status)
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_status = $status")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getListOrders()
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getOrderDetail($id)
    {
        $this->table = 'orderdetail';
        $data = $this->db->query("SELECT b.product_image, b.product_name, c.color_name, c.size_name, a.product_quantity, a.orderdetail_total FROM $this->table a INNER JOIN products b ON a.product_id = b.product_id INNER JOIN variations c ON a.variation_id =  c.variation_id WHERE order_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function acceptOrder($dataAcceptOrder, $id)
    {
        $this->table = 'orders';
        $data = [
            'order_status' => $dataAcceptOrder['orderstatus']
        ];
        $condition = 'order_id = ' . $id;
        $status = $this->db->update($this->table, $data, $condition);
        if (!$status) {
            return false;
        }
        return true;
    }
}
