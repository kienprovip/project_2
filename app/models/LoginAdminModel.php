<?php
class LoginAdminModel extends Model
{
    protected $table = '';
    public function getAdmin($email, $password)
    {
        $this->table = 'admin';
        $data = $this->db->query("SELECT * FROM $this->table WHERE admin_email = '$email' AND admin_password = '$password'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
