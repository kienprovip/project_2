<?php
class My_Account extends BaseController
{
    public $model;
    public $myAccountData = [];
    public $userId = null;

    public function __construct()
    {
        $this->model = $this->model('My_AccountModel');
    }

    public function register()
    {


        $data = $this->model('My_AccountModel');
        $registerData = $data->getAccounts();


        $title = 'Register';
        $this->myAccountData['page_title'] = $title;
        $this->myAccountData['content'] = 'clients/login/register';
        $this->myAccountData['sub_content']['account_list'] = $registerData;
        $this->myAccountData['sub_content'][] = null;

        // goi ra views
        $this->render('clients/login/myAccountLayout', $this->myAccountData);
    }



    public function registerAdd()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu từ form đăng ký, ví dụ: $_POST
            $password = md5($_POST['password']);
            $userData = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'phonenumber' => $_POST['phonenumber'],
                'email' => $_POST['email'],
                'password' => $password,
            ];

            // Gọi phương thức addAccount từ model để thêm tài khoản
            $registrationStatus = $this->model->addAccount($userData);

            if ($registrationStatus) {
                // Đăng ký thành công, có thể thực hiện các hành động khác (ví dụ: chuyển hướng)
                header("Location: login");
                exit();
            }
        }
    }

    public function login()
    {

        $title = 'Login';
        $this->myAccountData['page_title'] = $title;
        $this->myAccountData['content'] = 'clients/login/login';
        $this->myAccountData['sub_content'][] = null;

        // goi ra views
        $this->render('clients/login/myAccountLayout', $this->myAccountData);
    }

    public function loginCheck()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = md5($_POST['password']);
            $userData = [
                'email' => $_POST['email'],
                'password' => $password
            ];

            $loginCheckC = $this->model->getAccountC($userData);

            if (!empty($loginCheckC)) {
                $loginCheck = $this->model->getAccount($userData);
                $_SESSION['customer'] = $loginCheck;
                $this->getCartQuantity();
                if (isset($_SESSION['error_login'])) {
                    unset($_SESSION['error_login']);
                }
                header("Location: /project_2");
                exit();
            } else {
                $_SESSION['error_login'] = 'The email or the password is incorrect!';
                header("Location: login");
                exit();
            }
        }
    }


    public function logout()
    {
        unset($_SESSION['customer']);
        header('Location: /project_2/');
        exit();
    }
    public function getCartQuantity()
    {
        $this->model = $this->model('CartModel');
        $data = $this->model('CartModel');
        $getcartQuantity = $data->getCart();
        $count = 0;
        foreach ($getcartQuantity as $cart) {
            if ($cart['customer_id'] == $_SESSION['customer'][0]) {

                $count++;
            }
        }
        $_SESSION['cart_quantity'] = $count;
    }
}
