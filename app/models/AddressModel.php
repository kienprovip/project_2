<?php
class AddressModel extends Model
{
    protected $table = '';
    public function getProvinces()
    {
        $this->table = 'provinces';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getDistricts($province_id)
    {
        $this->table = 'districts';
        $data = $this->db->query("SELECT * FROM $this->table WHERE province_id = $province_id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getWards($district_id)
    {
        $this->table = 'wards';
        $data = $this->db->query("SELECT * FROM $this->table WHERE district_id = $district_id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProvinceName($id)
    {
        $this->table = 'provinces';
        $data = $this->db->query("SELECT province_name FROM $this->table WHERE province_id = $id")->fetchColumn();
        return $data;
    }
    public function getDistrictName($id)
    {
        $this->table = 'districts';
        $data = $this->db->query("SELECT district_name FROM $this->table WHERE district_id = $id")->fetchColumn();
        return $data;
    }
    public function getWardName($id)
    {
        $this->table = 'wards';
        $data = $this->db->query("SELECT ward_name FROM $this->table WHERE ward_id = $id")->fetchColumn();
        return $data;
    }
}
