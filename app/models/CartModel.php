<?php
class CartModel extends Model
{
    protected $table = '';
    public function getCart()
    {
        $this->table = 'carts';
        $data = $this->db->query("SELECT a.cart_id, a.product_id, a.variation_id, a.customer_id, a.cart_quantity, a.cart_status, b.product_name, b.product_current_price, b.product_image, b.product_status, b.product_quantity, c.color_name, c.size_name, c.variation_quantity FROM $this->table a INNER JOIN products b ON a.product_id = b.product_id INNER JOIN variations c ON a.variation_id = c.variation_id WHERE customer_id = '" . $_SESSION['customer'][0] . "' AND cart_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getCheckout($cartId)
    {
        $this->table = 'carts';
        $data = $this->db->query("SELECT a.cart_id, a.product_id, a.variation_id, b.product_name, b.product_current_price, b.product_image, c.color_name, c.size_name, a.cart_quantity FROM $this->table a INNER JOIN products b ON a.product_id = b.product_id INNER JOIN variations c ON a.variation_id = c.variation_id WHERE cart_id = '" . $cartId . "' AND cart_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function addToCart($data)
    {
        $this->table = 'carts';

        $dataInsert = [
            'product_id' => $data['productid'],
            'variation_id' => $data['variationid'],
            'cart_quantity' => $data['productquantity'],
            'customer_id' => $data['customerid'],
            'cart_status' => $data['status']
        ];

        $status = $this->db->insert($this->table, $dataInsert);

        if ($status) {
            return true;
        }

        return false;
    }

    public function updateCart($data, $id)
    {
        $this->table = 'carts';

        $dataUpdate = [
            'cart_quantity' => $data['cartquantity'],
            'cart_status' => $data['cartstatus']
        ];
        $condition = 'cart_id = ' . $id;

        $status = $this->db->update($this->table, $dataUpdate, $condition);
        if ($status) {
            return true;
        }
        return false;
    }

    public function deleteAll($data)
    {
        $this->table = 'carts';
        $dataDelete = [
            'cart_quantity' => $data['cartquantity'],
            'cart_status' => $data['cartstatus']
        ];
        $status = $this->db->update($this->table, $dataDelete);
        if ($status) {
            return true;
        }
        return false;
    }
}
