<?php
class OrdersModel extends Model
{
    protected $table = '';
    protected $lastId = 0;



    public function addOrder($dataOrder)
    {
        $this->table = 'orders';
        $data = [
            'customer_id' => $dataOrder['customerid'],
            'order_price' => $_SESSION['checkout_cart_total'],
            'customer_name' => $dataOrder['customername'],
            'customer_phone' => $dataOrder['customerphone'],
            'customer_address' => $dataOrder['customeraddress'],
            'order_pay' => $dataOrder['orderpay'],
            'order_note' => $dataOrder['ordernote'],
            'order_date' => $dataOrder['orderdate'],
            'order_quantity' => $dataOrder['orderquantity'],
            'shipping_price' => $dataOrder['shippingprice'],
            'discount_price' => $dataOrder['discountprice'],
            'order_status' => $dataOrder['orderstatus'],
        ];

        $status = $this->db->insert($this->table, $data);

        $this->lastId = $this->db->lastInsertId();
        if ($status) {
            return true;
        }

        return false;
    }

    public function getLastId()
    {
        return $this->lastId;
    }

    public function getOrderDetail($id)
    {
        $this->table = 'orderdetail';
        $data = $this->db->query("SELECT b.product_image, b.product_name, c.color_name, c.size_name, c.variation_id, b.product_id, a.orderdetail_id, a.product_quantity, a.orderdetail_total FROM $this->table a INNER JOIN products b ON a.product_id = b.product_id INNER JOIN variations c ON a.variation_id =  c.variation_id WHERE order_id = $id AND customer_id = " . $_SESSION['customer'][0])->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProductFromDetail($id)
    {
        $this->table = 'orderdetail';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getOrderForOrderdetail($id)
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_id = $id and customer_id = " . $_SESSION['customer'][0])->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getListOrders()
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE customer_id = " . $_SESSION['customer'][0])->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getListOrdersCondition($id)
    {
        $this->table = 'orders';
        $data = $this->db->query("SELECT * FROM $this->table WHERE order_status = $id AND customer_id = " . $_SESSION['customer'][0])->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function addOrderDetail($dataOrderDetail)
    {
        $this->table = 'orderdetail';
        $data = [
            'order_id' => $this->lastId,
            'product_id' => $dataOrderDetail['productid'],
            'variation_id' => $dataOrderDetail['variationid'],
            'orderdetail_total' => $dataOrderDetail['orderdetailtotal'],
            'customer_id' => $dataOrderDetail['customerid'],
            'product_price' => $dataOrderDetail['productprice'],
            'product_quantity' => $dataOrderDetail['productquantity'],
        ];
        $status = $this->db->insert($this->table, $data);
        if ($status) {
            return true;
        }
        return false;
    }

    public function deleteOrder($id, $dataDelete)
    {
        $this->table = 'orders';
        $condition = 'order_id = ' . $id;
        $data = [
            'order_status' => $dataDelete['orderstatus']
        ];
        $status = $this->db->update($this->table, $data, $condition);
        if ($status) {
            return true;
        }
        return false;
    }

    public function receivedOrder($id, $dataReceived)
    {
        $this->table = 'orders';
        $condition = 'order_id = ' . $id;
        $data = [
            'order_status' => $dataReceived['orderstatus'],
            'delivery_date' => $dataReceived['deliverydate']
        ];
        $status = $this->db->update($this->table, $data, $condition);
        if (!$status) {
            return false;
        }
        return true;
    }
}
