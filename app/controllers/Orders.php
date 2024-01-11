<?php
class Orders extends BaseController

{
    public $model;
    public $orderData = [];

    public function __construct()
    {
        $this->model = $this->model('OrdersModel');
    }

    public function index()
    {
        $data = $this->model('OrdersModel');

        $dataOrders = $data->getListOrders(); // tao bien de lay du lieu tu model
        $canceledOrders = $data->getListOrdersCondition(0);
        $processingOrders = $data->getListOrdersCondition(1);
        $shippingOrders = $data->getListOrdersCondition(2);
        $deliveriedOrders = $data->getListOrdersCondition(3);
        $title = 'Orders';
        $this->orderData['page_title'] = $title;
        $this->orderData['content'] = 'clients/orders/index';

        $this->orderData['sub_content']['orders'] = $dataOrders;
        $this->orderData['sub_content']['processing'] = $processingOrders;
        $this->orderData['sub_content']['shipping'] = $shippingOrders;
        $this->orderData['sub_content']['deliveried'] = $deliveriedOrders;
        $this->orderData['sub_content']['canceled'] = $canceledOrders;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->orderData);
    }

    public function orderDetail()
    {
        $data = $this->model('OrdersModel');
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $id = $_POST['order_id'];
            $dataOrders = $data->getOrderForOrderdetail($id);
            $dataOrderDetail = $data->getOrderDetail($id);
            $this->model = $this->model('FeedbackModel');
            $dataFeecback = $this->model('FeedbackModel');
            $listFeedback = $dataFeecback->getFeedbacks();

            $title = 'Order detail';
            $this->orderData['page_title'] = $title;
            $this->orderData['content'] = 'clients/orders/order-detail';

            $this->orderData['sub_content']['orders'] = $dataOrders;
            $this->orderData['sub_content']['orderdetail'] = $dataOrderDetail;
            $this->orderData['sub_content']['feedbacks'] = $listFeedback;

            // goi ra views
            $this->render('clients/layouts/clientLayout', $this->orderData);
        } // tao bien de lay du lieu tu model

    }

    public function buySuccessfuly($id)
    {
        $data = $this->model('OrdersModel');
        $dataOrders = $data->getOrderForOrderdetail($id);
        $dataOrderDetail = $data->getOrderDetail($id);
        $this->model = $this->model('FeedbackModel');
        $dataFeecback = $this->model('FeedbackModel');
        $listFeedback = $dataFeecback->getFeedbacks();

        $title = 'Order detail';
        $this->orderData['page_title'] = $title;
        $this->orderData['content'] = 'clients/orders/order-detail';

        $this->orderData['sub_content']['orders'] = $dataOrders;
        $this->orderData['sub_content']['orderdetail'] = $dataOrderDetail;
        $this->orderData['sub_content']['feedbacks'] = $listFeedback;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->orderData);
    }


    public function addOrder()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            // lấy id tỉnh, huyện, xã để lấy ra dữ liệu địa chỉ nhận hàng của khách hàng
            $provinceId = $_POST['city-province'];
            $districtId = $_POST['district'];
            $wardId = $_POST['ward'];

            $this->model = $this->model('AddressModel');
            $dataAddress = $this->model('AddressModel');

            $provinceName = $dataAddress->getProvinceName($provinceId);
            $districtName = $dataAddress->getDistrictName($districtId);
            $wardName = $dataAddress->getWardName($wardId);
            $spetificAddress = $_POST['specific-address'];

            $deliveryAddress = $spetificAddress . ' - ' . $wardName . ' - ' . $districtName . ' - ' . $provinceName;

            // tạo trước 1 phương thức thêm order vào bảng orders để lấy order_id tự động nhảy, khi hiển thị thì để thêm dấu #
            $currentTime = new DateTime('now', new DateTimeZone('UTC'));
            $newTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
            $currentTime->setTimezone($newTimeZone);
            $dateTime = $currentTime->format('Y-m-d H:i:s');
            $dataOrder = [
                'orderdate' => $dateTime,
                'orderpay' => $_POST['payment'],
                'customerid' => $_SESSION['customer'][0],
                'customername' => $_POST['first-name'] . ' ' . $_POST['last-name'],
                'customerphone' => $_POST['phone-number'],
                'customeraddress' => $deliveryAddress,
                'ordernote' => $_POST['order-note'],
                'orderquantity' => 1,
                'shippingprice' => $_SESSION['checkout_cart_shipping'],
                'discountprice' => $_SESSION['checkout_cart_discount'],
                'orderstatus' => 1
            ];


            $this->model = $this->model('OrdersModel');
            $addOrders = $this->model('OrdersModel');
            $this->model = $this->model('CartModel');
            $deleteCarts = $this->model('CartModel');
            $addOrder = $addOrders->addOrder($dataOrder);


            if ($addOrder) {
                foreach ($_SESSION['checkout'] as $item) {
                    $dataOrderDetail = [
                        'productid' => $item[0]['product_id'],
                        'variationid' => $item[0]['variation_id'],
                        'orderdetailtotal' => $item[0]['product_current_price'] * $item[0]['cart_quantity'],
                        'productquantity' => $item[0]['cart_quantity'],
                        'customerid' => $_SESSION['customer'][0],
                        'productprice' => $item[0]['product_current_price']
                    ];

                    $dataUpdateCart = [
                        'cartquantity' => 0,
                        'cartstatus' => 0
                    ];

                    $addOrderDetail =  $addOrders->addOrderDetail($dataOrderDetail);
                    if (isset($_SESSION['coupon_code']) && !empty($_SESSION['coupon_code'])) {
                        $this->model = $this->model('CouponModel');
                        $dataCoupon = $this->model('CouponModel');
                        $dataUpdateCoupon = [
                            'couponquantity' => $_SESSION['coupon_quantity'],
                            'couponstatus' => $_SESSION['coupon_status']
                        ];
                        echo $_SESSION['coupon_code'];
                        $sendUpdateCoupon = $dataCoupon->updateCoupon($_SESSION['coupon_id'], $dataUpdateCoupon);
                    }

                    $deleteCart = $deleteCarts->updateCart($dataUpdateCart, $item[0]['cart_id']);
                    $_SESSION['cart_quantity'] -= 1;
                    // sửa trạng thái của giỏ hàng về status = 0, số lượng giỏ hàng = 0
                    // cứ mỗi lần lặp này lại tạo ra 1 order detail riêng với mỗi id sản phẩm, id biến thể và số lượng của biến thể

                    $_SESSION['order_detail'][] = $dataOrderDetail;
                }
                $_SESSION['order'] = [
                    'customer_name' => $_POST['first-name'] . $_POST['last-name'],
                    'customer_phone' => $_POST['phone-number'],
                    'customer_address' =>  $deliveryAddress,
                ];

                $orderId = $addOrders->getLastId();
                $this->buySuccessfuly($orderId);
            }
        }
    }

    // khi hủy đơn hàng thì trả số lượng sản phẩm đã đặt hàng về như cũ, đặt trạng thái của đơn hàng về 0 để ẩn đi
    public function deleteOrder()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $order_id = $_POST['order_id'];
            $dataDeleteOrder = [
                'orderstatus' => 0
            ];

            $dataOrders = $this->model('OrdersModel');
            $dataorderDetail = $dataOrders->getOrderDetail($order_id);
            foreach ($dataorderDetail as $detail) {
                $this->model = $this->model('ProductModel');
                $dataProduct = $this->model('ProductModel');
                // lấy thông tin của biến thể ra bằng id biến thể
                $variation = $dataProduct->getVariationQuantity($detail['variation_id']);
                $product = $dataProduct->getProductToUpdate($detail['product_id']);

                foreach ($variation as $item) {
                    $variationQuantity = $item['variation_quantity'];
                    $updateVariation = [
                        'variationquantity' => $variationQuantity + $detail['product_quantity'],
                        'variationstatus' => 1
                    ];

                    $sendUpdateVariation = $dataProduct->updateVariation($updateVariation, $detail['variation_id']);
                }

                foreach ($product as $item) {
                    $productQuantity = $item['product_quantity'];
                    $updateProduct = [
                        'productquantity' => $productQuantity + $detail['product_quantity'],
                        'productstatus' => 1
                    ];

                    $sendUpdateProduct = $dataProduct->updateProductFromCart($updateProduct, $detail['product_id']);
                }
            }
            $sendDelete = $dataOrders->deleteOrder($order_id, $dataDeleteOrder);
            if ($sendDelete) {
                header('Location: /project_2/orders');
                exit();
            }
        }
    }

    public function receivedOrder()
    {
        $this->model = $this->model('OrdersModel');
        $dataOrder = $this->model('OrdersModel');
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $order_id = $_POST['order_id'];
            $currentTime = new DateTime('now', new DateTimeZone('UTC'));
            $newTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
            $currentTime->setTimezone($newTimeZone);
            $dateTime = $currentTime->format('Y-m-d H:i:s');
            $dataReceivedorder = [
                'orderstatus' => 3,
                'deliverydate' => $dateTime
            ];

            $orderDetail = $dataOrder->getProductFromDetail($order_id);
            $oldProductQuantity = 0;
            $productSell = 0;
            foreach ($orderDetail as $detail) {
                $productSell = $detail['product_quantity'];
                $this->model = $this->model('ProductModel');
                $dataProduct = $this->model('ProductModel');
                $listProducts = $dataProduct->getProductToUpdate($detail['product_id']);
                foreach ($listProducts as $product) {
                    $oldProductQuantity = $product['product_sold'];
                }
                $dataProductSold = [
                    'productsold' => $productSell + $oldProductQuantity
                ];
                $addProductSold = $dataProduct->addProductSold($dataProductSold, $detail['product_id']);
            }
            $sendReceivedOrder = $dataOrder->receivedOrder($order_id, $dataReceivedorder);
            if ($sendReceivedOrder) {
                header('Location: /project_2/orders');
                exit();
            }
        }
    }

    public function feedbackOrder()
    {
        $this->model = $this->model('FeedbackModel');
        $data = $this->model('FeedbackModel');
        $feedbackMessge = $_POST['feedback-content'];
        $variationId =  $_POST['variation_id'];
        $productId =  $_POST['product_id'];
        $orderId = $_POST['order_id'];
        $orderdetailId = $_POST['orderdetail_id'];
        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $newTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $currentTime->setTimezone($newTimeZone);
        $dateTime = $currentTime->format('Y-m-d H:i:s');
        $dataAddFeedback = [
            'feedbackmessage' => $feedbackMessge,
            'orderdetailid' => $orderdetailId,
            'productid' => $productId,
            'variationid' => $variationId,
            'customerid' => $_SESSION['customer'][0],
            'feedbackdatetime' => $dateTime
        ];

        $addFeedback = $data->addFeedback($dataAddFeedback);
        if ($addFeedback) {
            $this->buySuccessfuly($orderId);
        }
    }
}
