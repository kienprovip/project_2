<?php
class My_AccountModel extends Model
{
    protected $table = '';
    protected $data = [];

    public function getAccounts()
    {

        $this->table = 'customers';
        $data = $this->db->query("SELECT customer_email FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAccountC($userData)
    {
        $this->table = 'customers';

        $email = $userData['email'];
        $password = $userData['password'];

        $sql = "SELECT customer_id FROM $this->table WHERE customer_email = :email AND customer_password = :password";
        $params = [':email' => $email, ':password' => $password];

        $result = $this->db->query($sql, $params);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getAccount($userData)
    {
        $this->table = 'customers';
        $data = [];
        $email = $userData['email'];
        $password = $userData['password'];

        $sqlId = "SELECT customer_id FROM $this->table WHERE customer_email = :email AND customer_password = :password";
        $sqlName = "SELECT customer_name FROM $this->table WHERE customer_email = :email AND customer_password = :password";
        $sqlEmail = "SELECT customer_email FROM $this->table WHERE customer_email = :email AND customer_password = :password";
        $sqlPhone = "SELECT customer_phone FROM $this->table WHERE customer_email = :email AND customer_password = :password";
        $params = [':email' => $email, ':password' => $password];

        $resultId = $this->db->query($sqlId, $params);
        $resultName = $this->db->query($sqlName, $params);
        $resultEmail = $this->db->query($sqlEmail, $params);
        $resultPhone = $this->db->query($sqlPhone, $params);

        $dataId = $resultId->fetchColumn(); // Lấy giá trị từ cột 'customer_id'
        $dataName = $resultName->fetchColumn(); // Lấy giá trị từ cột 'customer_name'
        $dataEmail = $resultEmail->fetchColumn(); // Lấy giá trị từ cột 'customer_email'
        $dataPhone = $resultPhone->fetchColumn(); // Lấy giá trị từ cột 'customer_phone'


        $data = [
            $dataId,
            $dataName,
            $dataEmail,
            $dataPhone,
        ];

        return $data;
    }


    public function addAccount($userData)
    {
        $this->table = 'customers';

        // Assuming $userData is an array containing the data you want to insert
        $data = [
            'customer_name' => $userData['firstname'] . ' ' . $userData['lastname'],
            'customer_phone' => $userData['phonenumber'],
            'customer_email' => $userData['email'],
            'customer_password' => $userData['password'],
            'customer_image' => 'user_avatar.png',
            'customer_status' => 1
            // Note: In a real application, you should hash the password
            // Add more fields as needed
        ];

        $status = $this->db->insert($this->table, $data);

        if ($status) {
            return true;
        }

        return false;
    }
}
