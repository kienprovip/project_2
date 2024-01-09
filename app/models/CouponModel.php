<?php
class CouponModel extends Model
{
    protected $table = '';
    public function getListCoupons($time)
    {
        $this->table = 'coupons';
        $data = $this->db->query("SELECT * FROM $this->table WHERE coupon_status = 1 AND coupon_finish >= '$time'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getCoupon($code, $total, $time)
    {
        $this->table = 'coupons';
        $data = $this->db->query("SELECT coupon_price FROM $this->table  WHERE coupon_code = '$code' AND min_total <= $total AND coupon_status = 1 AND coupon_start <= '$time' AND '$time' <= coupon_finish")->fetchColumn();
        return $data;
    }

    public function getCouponQuantity($code)
    {
        $this->table = 'coupons';
        $data = $this->db->query("SELECT coupon_quantity, coupon_id FROM $this->table WHERE coupon_code = '$code' AND coupon_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateCoupon($code, $receiveData)
    {
        $this->table = 'coupons';
        $condition = 'coupon_id = ' . $code;
        $data = [
            'coupon_quantity' => $receiveData['couponquantity'],
            'coupon_status' => $receiveData['couponstatus']
        ];
        $status = $this->db->update($this->table, $data, $condition);
        if ($status) {
            return true;
        }
        return false;
    }

    public function addCoupon($dataAddCoupon)
    {
        $this->table = 'coupons';
        $data = [
            'coupon_code' => $dataAddCoupon['couponcode'],
            'coupon_quantity' => $dataAddCoupon['couponquantity'],
            'coupon_price' => $dataAddCoupon['couponprice'],
            'min_total' => $dataAddCoupon['mintotal'],
            'coupon_start' => $dataAddCoupon['couponstart'],
            'coupon_finish' => $dataAddCoupon['couponfinish'],
            'coupon_status' => $dataAddCoupon['couponstatus']
        ];
        $status = $this->db->insert($this->table, $data);
        if (!$status) {
            return false;
        }
        return true;
    }
}
