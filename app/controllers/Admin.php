<?php
class Admin extends BaseController

{

    public $model;
    private $adminData = [];

    public function __construct()
    {
        $this->model = $this->model('DashboardModel');
    }

    public function login()
    {
        $title = 'Login';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/login/login';
        $this->adminData['sub_content'][] = null;

        // goi ra views
        $this->render('admin/login/login', $this->adminData);
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['error_login_admin']);
        header('Location: /project_2/admin/login');
        exit();
    }

    public function loginCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $this->model = $this->model('LoginAdminModel');
            $dataLogin = $this->model('LoginAdminModel');
            $check = $dataLogin->getAdmin($email, $password);
            if (!empty($check)) {
                $_SESSION['admin'] = 'allow login';
                header('Location: /project_2/admin/dashboard');
                exit();
            } else {
                $_SESSION['error_login_admin'] = 'The email or the password is incorrect!';
                header('Location: /project_2/admin/login');
                exit();
            }
        }
    }
    public function dashboard()
    {
        $data = $this->model('DashboardModel');
        $dataProducts = $data->getAllProduct(); // tao bien de lay du lieu tu model

        $this->model = $this->model('OrdersAdminModel');
        $dataOrders = $this->model('OrdersAdminModel');

        $getNewOrders = $dataOrders->getNewOrders();
        $listDelivery = $dataOrders->getListOrderStatus(3);
        $dashboardMonthAgo = $dataOrders->incomeFluctuationsMonthAgo();
        $dashboardMonthCurrent = $dataOrders->incomeFluctuationsMonthCurrent();

        $title = 'Dashboard';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/dashboard/dashboard';

        $this->adminData['sub_content']['products'] = $dataProducts;
        $this->adminData['sub_content']['ordersnew'] = $getNewOrders;
        $this->adminData['sub_content']['delivery'] = $listDelivery;
        $this->adminData['sub_content']['month_ago'] = $dashboardMonthAgo;
        $this->adminData['sub_content']['month_current'] = $dashboardMonthCurrent;

        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function analytics()
    {
        $data = $this->model('AnalyticsModel');

        $title = 'Analytics';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/analytics/analytics';

        $this->adminData['sub_content']['month1'] = $data->getAnalytics(1);
        $this->adminData['sub_content']['month2'] = $data->getAnalytics(2);
        $this->adminData['sub_content']['month3'] = $data->getAnalytics(3);
        $this->adminData['sub_content']['month4'] = $data->getAnalytics(4);
        $this->adminData['sub_content']['month5'] = $data->getAnalytics(5);
        $this->adminData['sub_content']['month6'] = $data->getAnalytics(6);
        $this->adminData['sub_content']['month7'] = $data->getAnalytics(7);
        $this->adminData['sub_content']['month8'] = $data->getAnalytics(8);
        $this->adminData['sub_content']['month9'] = $data->getAnalytics(9);
        $this->adminData['sub_content']['month10'] = $data->getAnalytics(10);
        $this->adminData['sub_content']['month11'] = $data->getAnalytics(11);
        $this->adminData['sub_content']['month12'] = $data->getAnalytics(12);

        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function products()
    {

        $data = $this->model('ProductsModel');
        $dataProducts = $data->getCategories(); // tao bien de lay du lieu tu model
        $title = 'Products';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/products/products';
        $this->adminData['sub_content']['category_list'] = $dataProducts;
        //lấy danh sách sản phẩm
        $dataListProduct = $data->getListProduct();
        $this->adminData['sub_content']['product_list'] = $dataListProduct;
        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function updateproduct()
    {
        // Kiểm tra xem có dữ liệu POST được gửi hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy giá trị product_id từ form
            $this->model = $this->model("ProductsModel");
            $data = $this->model('ProductsModel');
            $title = 'UpdateProduct';
            $this->adminData['page_title'] = $title;
            $this->adminData['content'] = 'admin/products/UpdateProduct';
            $dataProductID = $data->GetProductID($_POST['productId']);
            $this->adminData['sub_content']['product_listid'] = $dataProductID;
            $dataVariations = $data->GetVariation($_POST['productId']);
            $this->adminData['sub_content']['variation_listid'] = $dataVariations;
            $this->render('admin/layouts/adminLayout', $this->adminData);
        }
    }
    public function checkUpdateProduct()
    {
        $this->model = $this->model('ProductsModel');
        $dataProduct = $this->model('ProductsModel');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $count = $_POST['count'];
            $id = $_POST['productID'];
            $countAddVariation = $_POST['countAddVariation'];
            $variation_quantity = [];
            $Ivariationquantity = [];
            $total_quantity = 0;
            $total_Ivariationquantity = 0;
            $total = 0;

            for ($i = 1; $i <= $countAddVariation; $i++) {
                // Kiểm tra xem giá trị có tồn tại hay không trước khi thêm vào mảng
                if (!empty($_POST['Ivariationquantity' . $i])) {
                    $Ivariationquantity[$i] = $_POST['Ivariationquantity' . $i];
                } else {
                    $Ivariationquantity[$i] = 0; // Giá trị mặc định nếu không tồn tại
                }
                $total_Ivariationquantity += $Ivariationquantity[$i];
            }

            for ($i = 1; $i <= $count; $i++) {
                if (!empty($_POST['variationquantity' . $i])) {
                    $variation_quantity[$i] = $_POST['variationquantity' . $i];
                } else {
                    $variation_quantity[$i] = 0; // Giá trị mặc định nếu không tồn tại
                }

                $total_quantity += $variation_quantity[$i];
            }


            // Tổng số lượng sản phẩm
            $total = $total_quantity + $total_Ivariationquantity;




            // Xử lý dữ liệu từ form update, ví dụ: $_POST
            $userDataUP = [
                'product_id' => $id,
                'productimage' => $_POST['image'],
                'productname' => $_POST['productname'],
                'productcost' => $_POST['productprice'],
                'product_discount_price' => $_POST['productdiscount'],
                'product_thumbnail1' => $_POST['productthumbnail1'],
                'product_thumbnail2' => $_POST['productthumbnail2'],
                'product_thumbnail3' => $_POST['productthumbnail3'],
                'product_describe' => $_POST['productdescribe'],
                'product_status' => 1,
                'product_quantity' => $total
            ];
            $userData = [
                'product_id' => $id,
                'productimage' => $_POST['imageUP'],
                'productname' => $_POST['productname'],
                'productcost' => $_POST['productprice'],
                'product_discount_price' => $_POST['productdiscount'],
                'product_thumbnail1' => $_POST['productthumbnail1UP'],
                'product_thumbnail2' => $_POST['productthumbnail2UP'],
                'product_thumbnail3' => $_POST['productthumbnail3UP'],
                'product_describe' => $_POST['productdescribe'],
                'product_status' => 1,
                'product_quantity' => $total

            ];
            if (!empty($_POST['image']) && !empty($_POST['productthumbnail1']) && !empty($_POST['productthumbnail2']) && !empty($_POST['productthumbnail3'])) {
                $productStatus = $this->model->UpdateProduct($userDataUP, $id);
            } else {
                $productStatus = $this->model->UpdateProduct($userData, $id);
            }
            $userDataV = [];
            for ($i = 1; $i <= $count; $i++) {
                $idV[$i] = $_POST['variation_id' . $i];
                $userDataV[$i] = [
                    'colorname' . $i => ucwords($_POST['colorname' . $i]),
                    'sizename' . $i => strtoupper($_POST['sizename' . $i]),
                    'variationquantity' . $i => $_POST['variationquantity' . $i]
                ];
            }
            $variationStatus = $this->model->UpdateVariation($userDataV, $count, $idV);
            // TRuyền product_id sang model để lấy dữ liệu
            $dataVariationss = $this->model->GetVariationID($id);

            // Lấy dữ liệu xử lí truy vấn
            $dataProduct = $this->model('ProductsModel');
            $dataVariationsID = $dataProduct->GetVariationID($id);
            $countVariation = 0;
            $InsertDataV = [];
            $oldVariationQuantity = 0;
            $inputVariationQuantity = 0;
            $variationId = 0;
            $DataVStatus = false; // Khởi tạo giá trị mặc định

            foreach ($dataVariationsID as $item) {
                for ($i = 1; $i <= $countAddVariation; $i++) {
                    if (!empty($_POST['Icolorname' . $i]) && !empty($_POST['Isizename' . $i]) && !empty($_POST['Ivariationquantity' . $i])) {
                        if (strtoupper($item['size_name']) == strtoupper($_POST['Isizename' . $i]) && ucwords($item['color_name']) == ucwords($_POST['Icolorname' . $i])) {
                            $countVariation++;
                            $oldVariationQuantity = $item['variation_quantity'];
                            $inputVariationQuantity = $_POST['Ivariationquantity' . $i];
                            $variationId = $item['variation_id'];
                        }
                    }
                }
            }

            if ($countVariation === 0) {
                // Thêm mới variation tại địa chỉ $id
                for ($i = 1; $i <= $countAddVariation; $i++) {
                    if (!empty($_POST['Icolorname' . $i]) && !empty($_POST['Isizename' . $i]) && !empty($_POST['Ivariationquantity' . $i])) {
                        $InsertDataV[] = [
                            'product_id' => $id,
                            'Icolorname' . $i => ucwords($_POST['Icolorname' . $i]),
                            'Isizename' . $i => strtoupper($_POST['Isizename' . $i]),
                            'Ivariationquantity' . $i => $_POST['Ivariationquantity' . $i],
                            'Ivariation_status' . $i => 1
                        ];
                        $DataIVariation = $this->model->InsertVariation($InsertDataV, $countAddVariation);
                    }
                }
            } else {
                // Thêm phần tử vào mảng $UpdateDataV cho mỗi biến thể
                $UpdateDataV = [
                    'Ivariation_quantity' => $inputVariationQuantity + $oldVariationQuantity,
                    // Các khóa khác nếu cần thiết
                ];
                $DataVStatus = $this->model->UpdateQuantityVariation($UpdateDataV, $variationId);
            }

            if ($DataVStatus) {
                // Xử lý khi cập nhật thành công
                print_r($UpdateDataV);
            } else {
                // Xử lý khi cập nhật không thành công hoặc không có biến thể
            }

            // Đăng ký thành công, có thể thực hiện các hành động khác (ví dụ: chuyển hướng)
            header("Location: /project_2/admin/products");
            exit();
        }
    }
    public function DeleteProduct()
    {
        $title = 'Delete product';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/products/deleteProduct';
        $this->adminData['sub_content']['delete'] = $_POST['product_idD'];
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function checkDeleteProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $id = $_POST['product_idD'];
            $this->model = $this->model("ProductsModel");
            $DeleteProduct = $this->model->DeleteProduct($id);
            if ($DeleteProduct) {
                header('Location: /project_2/admin/products');
                exit();
            }
        }
    }
    public function productdetail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy giá trị product_id từ form
            $data = $this->model('ProductsModel');
            $title = 'Product detail';
            $this->adminData['page_title'] = $title;
            $this->adminData['content'] = 'admin/products/InformationProduct';
            $dataProductID = $data->GetProductID($_POST['productId']);
            $this->adminData['sub_content']['product_listid'] = $dataProductID;
            $dataVariations = $data->GetVariation($_POST['productId']);
            $this->adminData['sub_content']['variation_listid'] = $dataVariations;
            $this->render('admin/layouts/adminLayout', $this->adminData);
        }
    }

    public function addProduct()
    {
        $this->model = $this->model('ProductsModel');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu từ form đăng ký, ví dụ: $_POST
            $countProduct = 0;

            $variationData = [];
            for ($i = 1; $i <= $_SESSION['variation_quantity']; $i++) {
                if (!empty($_POST['colorname' . $i]) && !empty($_POST['sizename' . $i]) && !empty($_POST['variationquantity' . $i])) {
                    $variationData[$i] = [
                        'colorname' . $i => $_POST['colorname' . $i],
                        'sizename' . $i => $_POST['sizename' . $i],
                        'variationquantity' . $i => $_POST['variationquantity' . $i],
                    ];
                    $countProduct += $_POST['variationquantity' . $i];
                }
            }
            $currentTime = new DateTime('now', new DateTimeZone('UTC'));
            $newTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
            $currentTime->setTimezone($newTimeZone);
            $dateTime = $currentTime->format('Y-m-d H:i:s');
            $statusprd = 1;
            if ($countProduct == 0) {
                $statusprd = 0;
            }

            $productData = [
                'categoryid' => $_POST['categoryid'],
                'productcost' => $_POST['productprice'],
                'productname' => $_POST['productname'],
                'productimage' => $_POST['productimage'],
                'productthumbnail1' => $_POST['productthumbnail1'],
                'productthumbnail2' => $_POST['productthumbnail2'],
                'productthumbnail3' => $_POST['productthumbnail3'],
                'productdescribe' => $_POST['productdescribe'],
                'productdate' => $dateTime,
                'productstatus' => $statusprd,
                'productquantity' => $countProduct,
            ];


            $productStatus = $this->model->addProduct($productData);
            $variationStatus = $this->model->addVariation($variationData);
            if ($productStatus && $variationStatus) {
                header("Location: /project_2/admin/products");
                exit();
            }
        }
    }



    public function map()
    {


        $title = 'Map';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/map/map';

        $this->adminData['sub_content'][] = null;

        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function coupons()
    {
        $this->model = $this->model('CouponModel');
        $dataCoupon = $this->model('CouponModel');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('Y-m-d H:i:s');
        $listCoupons = $dataCoupon->getListCoupons($current_time);
        $title = 'Coupons';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/coupons/coupons';

        $this->adminData['sub_content']['coupons'] = $listCoupons;

        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function addCoupon()
    {
        $formatCouponStart = new DateTime($_POST['coupon_start']);
        $formatCouponFinish = new DateTime($_POST['coupon_finish']);
        $couponCode = $_POST['coupon_code'];
        $couponPrice = $_POST['coupon_price'];
        $couponBillMin = $_POST['bill_minimum'];
        $couponQuantity = $_POST['coupon_quantity'];
        $couponStart = $formatCouponStart->format('Y-m-d H:i:s');
        $couponFinish = $formatCouponFinish->format('Y-m-d H:i:s');
        $dataAddCoupon = [
            'couponcode' => $couponCode,
            'couponprice' => $couponPrice,
            'mintotal' => $couponBillMin,
            'couponstart' => $couponStart,
            'couponfinish' => $couponFinish,
            'couponquantity' => $couponQuantity,
            'couponstatus' => 1
        ];
        $this->model = $this->model('CouponModel');
        $dataCoupon = $this->model('CouponModel');

        $addCoupon = $dataCoupon->addCoupon($dataAddCoupon);
        if ($addCoupon) {
            header('Location: /project_2/admin/coupons');
            exit();
        }
    }

    public function orders()
    {
        $this->model = $this->model('OrdersAdminModel');
        $dataOrders = $this->model('OrdersAdminModel');
        $listOrders = $dataOrders->getListOrders();
        $listCanceledOrder = $dataOrders->getListOrderStatus(0);
        $listProcessingOrder = $dataOrders->getListOrderStatus(1);
        $listShippingOrder = $dataOrders->getListOrderStatus(2);
        $listDeliveriedOrder = $dataOrders->getListOrderStatus(3);
        $title = 'Orders';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/orders/orders';

        $this->adminData['sub_content']['orders'] = $listOrders;
        $this->adminData['sub_content']['canceled'] = $listCanceledOrder;
        $this->adminData['sub_content']['processing'] = $listProcessingOrder;
        $this->adminData['sub_content']['shipping'] = $listShippingOrder;
        $this->adminData['sub_content']['deliveried'] = $listDeliveriedOrder;

        // goi ra views
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }

    public function processOrder()
    {
        $this->model = $this->model('OrdersAdminModel');
        $dataOrder = $this->model('OrdersAdminModel');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['accept'])) {
                $dataAcceptOrder = [
                    'orderstatus' => 2
                ];
                $acceptOrder = $dataOrder->acceptOrder($dataAcceptOrder, $_POST['order_id']);
                echo $_POST['order_id'];
                if ($acceptOrder) {
                    header('Location: /project_2/admin/orders');
                }
            } elseif (isset($_POST['cancel'])) {
                $dataAcceptOrder = [
                    'orderstatus' => 0
                ];
                $acceptOrder = $dataOrder->acceptOrder($dataAcceptOrder, $_POST['order_id']);
                echo $_POST['order_id'];
                if ($acceptOrder) {
                    header('Location: /project_2/admin/orders');
                }
            }
        }
    }

    public function orderDetail()
    {
        $data = $this->model('OrdersAdminModel');
        $getDetail = $data->getOrderDetail($_POST['order_id']);
        $getOrder = $data->getListOrdersCondition($_POST['order_id']);
        $title = 'Order detail';
        $this->adminData['page_title'] = $title;
        $this->adminData['content'] = 'admin/orders/order_detail';
        $this->adminData['sub_content']['detail'] = $getDetail;
        $this->adminData['sub_content']['order'] = $getOrder;
        $this->render('admin/layouts/adminLayout', $this->adminData);
    }
}
