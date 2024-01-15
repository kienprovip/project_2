<?php
class Cart extends BaseController
{
    public $model;
    public $cartData = [];

    public function __construct()
    {
        $this->model = $this->model('CartModel');
    }

    public function index()
    {
        $data = $this->model('CartModel');

        $dataCart = $data->getCart(); // tao bien de lay du lieu tu model

        $title = 'Cart';
        $this->cartData['page_title'] = $title;
        $this->cartData['content'] = 'clients/cart/index';

        $this->cartData['sub_content']['cart_list'] = $dataCart;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->cartData);
    }

    public function getDistrict()
    {
        $tinh = $_POST['tinh'];
        $this->model = $this->model('AddressModel');
        $data = $this->model('AddressModel');
        $getDistricts = $data->getDistricts($tinh);
        // Thực hiện truy vấn để lấy danh sách huyện từ database (ví dụ)
        // $danhsach_huyen = query_database($tinh);
        // Sau đó, trả về dữ liệu dưới dạng HTML cho JavaScript
        foreach ($getDistricts as $item) {
            echo "<option value='" . $item['district_id'] . "'>" . $item['district_name'] . "</option>";
        }
    }

    public function getWard()
    {
        $huyen = $_POST['huyen'];
        $this->model = $this->model('AddressModel');
        $data = $this->model('AddressModel');
        $getWards = $data->getWards($huyen);
        // Thực hiện truy vấn để lấy danh sách huyện từ database (ví dụ)
        // $danhsach_huyen = query_database($tinh);
        // Sau đó, trả về dữ liệu dưới dạng HTML cho JavaScript
        foreach ($getWards as $item) {
            echo "<option value='" . $item['ward_id'] . "'>" . $item['ward_name'] . "</option>";
        }
    }

    public function checkout()
    {
        $this->model = $this->model('AddressModel');
        $data = $this->model('AddressModel');
        $getProvinces = $data->getProvinces();
        $title = 'Checkout';
        $this->cartData['page_title'] = $title;
        $this->cartData['content'] = 'clients/cart/checkout';
        $this->cartData['sub_content']['provinces'] = $getProvinces;

        $this->render('clients/layouts/clientLayout', $this->cartData);
    }

    public function addToCart()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_SESSION['customer'][0])) {
            $this->model = $this->model('ProductModel');
            $dataVariationId = $this->model('ProductModel');
            $variationId = $_POST['variation_id'];
            $this->model = $this->model('CartModel');
            $data = $this->model('CartModel');
            $issetCart = $data->getCart();


            $chooceQuantity = $_POST['product_quantity']; // số lượng sản phẩm được nhập vào ở trang chi tiết
            $productQuantityCurrent = $_POST['product_quantity_current']; // số lượng sản phẩm hiện có trong kho
            $count = 0;
            $oldQuantity = 0; // gọi biến lưu giá trị số lượng sản phẩm đang có trong giỏ hàng hay chưa
            $oldVariationQuantity = 0; // số lượng giá trị biến thể có trong kho
            $cartId = 0;


            foreach ($issetCart as $item) {

                // kiểm tra xem lúc thêm giỏ hàng thì sản phẩm đấy đã tồn tại trong giỏ hàng chưa
                if ($variationId == $item['variation_id'] && $_POST['product_id'] == $item['product_id'] && $item['customer_id'] == $_SESSION['customer'][0]) {
                    $count++; // đếm xem có hay hay không
                    $oldQuantity = $item['cart_quantity']; // gán số lượng cũ vào
                    $oldVariationQuantity = $item['variation_quantity']; // số lượng sản phẩm cũ trong kho
                    $cartId = $item['cart_id']; // lấy id của giỏ hàng để cập nhật
                }
            }

            // update variation quantity

            $this->model = $this->model('ProductModel');
            $dataProduct = $this->model('ProductModel');
            $getProduct = $dataProduct->getListProducts();
            $getVariation = $dataProduct->getVariationQuantity($variationId);


            // nếu biến $count >= 1 tức là có sản phẩm + biến thể đấy đã tồn tại trong giỏ hàng
            if ($count >= 1) {
                // mình chỉ update tăng số lượng lên
                $cartUpdate = [
                    'cartquantity' => $oldQuantity + $chooceQuantity,
                    'cartstatus' => 1
                ];

                $currentVariationQuantity = $oldVariationQuantity - $chooceQuantity;
                $variationStatus = 1;
                if ($currentVariationQuantity = 0) {
                    $variationStatus = 0;
                }

                // mảng dữ liệu cập nhật biến thể
                $variationUpdate = [
                    'variationquantity' => $currentVariationQuantity, // biến thể hiện tại để cập nhật
                    'variationstatus' => $variationStatus // trạng thái biến thể hiện tại
                ];

                $currentProductQuantity = $productQuantityCurrent - $chooceQuantity;
                $productStatus = 1;
                if ($currentProductQuantity == 0) {
                    $productStatus = 0;
                }
                $productUpdate = [
                    'productquantity' => $currentProductQuantity,
                    'productstatus' => $productStatus
                ];


                $updateCart = $data->updateCart($cartUpdate, $cartId);
                $updateVariationQuantity = $dataProduct->updateVariation($variationUpdate, $variationId);
                $updateProductQuantity = $dataProduct->updateProductFromCart($productUpdate, $_POST['product_id']);
                if ($updateCart && $updateVariationQuantity && $updateProductQuantity) {
                    header('Location: /project_2/cart');
                    exit();
                }
            } else {
                $_SESSION['cart_quantity'] += 1; // tăng số lượng hiển thị số id giỏ hàng của người dùng
                $cartData = [
                    'productid' => $_POST['product_id'],
                    'variationid' => $variationId,
                    'productquantity' => $_POST['product_quantity'],
                    'customerid' => $_SESSION['customer'][0],
                    'status' => 1
                ];

                foreach ($getVariation as $a) {
                    $oldVariationQuantity = $a['variation_quantity'];
                }

                $currentVariationQuantity = $oldVariationQuantity - $chooceQuantity;
                $variationStatus = 1;
                if ($currentVariationQuantity == 0) {
                    $variationStatus = 0;
                } elseif ($currentVariationQuantity < 0) {
                    header('Location: /project_2/cart');
                    exit();
                }
                $variationUpdate = [
                    'variationquantity' => $currentVariationQuantity,
                    'variationstatus' => $variationStatus
                ];

                $currentProductQuantity = $productQuantityCurrent - $chooceQuantity;
                $productStatus = 1;
                if ($currentProductQuantity == 0) {
                    $productStatus = 0;
                }
                $productUpdate = [
                    'productquantity' => $currentProductQuantity,
                    'productstatus' => $productStatus
                ];
                $updateVariationQuantity = $dataProduct->updateVariation($variationUpdate, $variationId);
                $addCart = $data->addToCart($cartData);
                $updateProductQuantity = $dataProduct->updateProductFromCart($productUpdate, $_POST['product_id']);
                if ($addCart && $updateVariationQuantity && $updateProductQuantity) {

                    header('Location: /project_2/cart');
                    exit();
                }
            }
        } else {
            header('Location: /project_2/my_account/login');
        }
    }

    public function changeQuantity()
    {
        $this->model = $this->model('CartModel');
        $dataCart = $this->model('CartModel');
        $this->model = $this->model('ProductModel');
        $dataProduct = $this->model('ProductModel');
        $dataVariation = $this->model('ProductModel');
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $cart_id = $_POST['cart_id'];
            $cart_quantity = $_POST['cart_quantity'];
            $variation_id = $_POST['variation_id'];
            $variation_quantity = $_POST['variation_quantity'];
            $product_id = $_POST['product_id'];
            $product_quantity = $_POST['product_quantity'];
            if (isset($_POST['minus'])) {
                $cart_status = 1;
                $cart_quantity_minus = $cart_quantity - 1;
                if ($cart_quantity_minus == 0) {
                    $cart_status = 0;
                    $_SESSION['cart_quantity'] -= 1;
                }
                $dataUpdateCart = [
                    'cartquantity' => $cart_quantity_minus,
                    'cartstatus' => $cart_status,
                ];


                $product_quantity_minus = $product_quantity + 1;
                $dataUpdateProduct = [
                    'productquantity' => $product_quantity_minus,
                    'productstatus' => 1
                ];

                $variation_quantity_minus = $variation_quantity + 1;
                $dataUpdateVariation = [
                    'variationquantity' => $variation_quantity_minus,
                    'variationstatus' => 1
                ];

                $sendUpdateVariation = $dataVariation->updateVariation($dataUpdateVariation, $variation_id);
                $sendUpdateProduct = $dataProduct->updateProductFromCart($dataUpdateProduct, $product_id);
                $sendUpdateCart = $dataCart->updateCart($dataUpdateCart, $cart_id);
                if ($sendUpdateCart && $sendUpdateProduct && $sendUpdateVariation) {
                    header('Location: /project_2/cart');
                    exit();
                }
            } elseif (isset($_POST['plus'])) {
                $cart_quantity_plus = $cart_quantity + 1;
                $dataUpdateCart = [
                    'cartquantity' => $cart_quantity_plus,
                    'cartstatus' => 1
                ];

                $product_status = 1;
                $product_quantity_plus = $product_quantity - 1;
                if ($product_quantity_plus == 0) {
                    $product_status = 0;
                } elseif ($product_quantity_plus < 0) {
                    header('Location: /project_2/cart');
                    exit();
                }
                $dataUpdateProduct = [
                    'productquantity' => $product_quantity_plus,
                    'productstatus' => $product_status
                ];

                $variation_status = 1;
                $variation_quantity_plus = $variation_quantity - 1;
                if ($variation_quantity_plus == 0) {
                    $variation_status = 0;
                } elseif ($variation_quantity_plus < 0) {
                    header('Location: /project_2/cart');
                    exit();
                }
                $dataUpdateVariation = [
                    'variationquantity' => $variation_quantity_plus,
                    'variationstatus' => $variation_status,
                ];

                $sendUpdateVariation = $dataVariation->updateVariation($dataUpdateVariation, $variation_id);
                $sendUpdateProduct = $dataProduct->updateProductFromCart($dataUpdateProduct, $product_id);
                $sendUpdateCart = $dataCart->updateCart($dataUpdateCart, $cart_id);
                if ($sendUpdateCart && $sendUpdateProduct && $sendUpdateVariation) {
                    header('Location: /project_2/cart');
                    exit();
                }
            }
        }
    }

    public function deleteOne()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $cart_id = $_POST['cart_id'];
            $dataCart = $this->model('CartModel');
            $this->model = $this->model('ProductModel');
            $dataProduct = $this->model('ProductModel');
            $productId = $_POST['product_id'];
            $variationId = $_POST['variation_id'];
            $cartQuantity = $_POST['cart_quantity'];
            $getProductQuantity = $dataProduct->getProductToUpdate($productId);
            $getVariationQuantity = $dataProduct->getVariationQuantity($variationId);
            $productQuantity = 1;
            foreach ($getProductQuantity as $product) {
                $productQuantity = $product['product_quantity'];
            }
            $variationQuantity = 1;
            foreach ($getVariationQuantity as $variation) {
                $variationQuantity = $variation['variation_quantity'];
            }
            print_r($getProductQuantity);
            echo '</>';
            print_r($getVariationQuantity);
            $dataDelete = [
                'cartquantity' => 0,
                'cartstatus' => 0
            ];
            $dataUpdateVariation = [
                'variationquantity' => $variationQuantity + $cartQuantity,
                'variationstatus' => 1
            ];
            $dataUpdateProduct = [
                'productquantity' => $productQuantity + $cartQuantity,
                'productstatus' => 1
            ];
            $sendDelete = $dataCart->updateCart($dataDelete, $cart_id);
            $sendUpdateProduct = $dataProduct->updateProductFromCart($dataUpdateProduct, $productId);
            $sendUpdateVariation = $dataProduct->updateVariation($dataUpdateVariation, $variationId);
            if ($sendDelete && $sendUpdateProduct && $sendUpdateVariation) {
                $_SESSION['cart_quantity'] -= 1;
                header('Location: /project_2/cart');
                exit();
            }
        }
    }
    public function deleteAll()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $dataCart = $this->model('CartModel');
            $getCart = $dataCart->getCart();
            foreach ($getCart as $cart) {
                $this->model = $this->model('ProductModel');
                $dataProduct = $this->model('ProductModel');
                $getProductQuantity = $dataProduct->getProductToUpdate($cart['product_id']);
                $getVariationQuantity = $dataProduct->getVariationQuantity($cart['variation_id']);
                $productQuantity = 1;
                $variationQuantity = 1;
                foreach ($getProductQuantity as $product) {
                    $productQuantity = $product['product_quantity'];
                }
                foreach ($getVariationQuantity as $variation) {
                    $variationQuantity = $variation['variation_quantity'];
                }

                $dataUpdateVariation = [
                    'variationquantity' => $variationQuantity + $cart['cart_quantity'],
                    'variationstatus' => 1
                ];

                $dataUpdateProduct = [
                    'productquantity' => $productQuantity + $cart['cart_quantity'],
                    'productstatus' => 1
                ];

                $sendUpdateVariation = $dataProduct->updateVariation($dataUpdateVariation, $cart['variation_id']);
                $sendUpdateProduct = $dataProduct->updateProductFromCart($dataUpdateProduct, $cart['product_id']);
            }
            $dataDelete = [
                'cartquantity' => 0,
                'cartstatus' => 0
            ];
            $sendDeleteAll = $dataCart->deleteAll($dataDelete);
            if ($sendDeleteAll) {
                $_SESSION['cart_quantity'] = 0;
                header('Location: /project_2/cart');
                exit();
            }
        }
    }

    public function applyCoupon()
    {
        $total = $_POST['price'];
        $couponCode = $_POST['coupon'];
        $this->model = $this->model('CouponModel');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('Y-m-d H:i:s');
        $data = $this->model('CouponModel');
        $discount = $data->getCoupon($couponCode, $total, $current_time);
        $discountQuantity = $data->getCouponQuantity($couponCode);
        $couponId = 0;
        if (!empty($discount)) {
            $_SESSION['coupon_code'] = strtoupper($_POST['coupon']);
            foreach ($discountQuantity as $coupon) {
                $couponQuantity = $coupon['coupon_quantity'] - 1;
                $couponId = $coupon['coupon_id'];
            }

            $_SESSION['coupon_quantity'] = $couponQuantity;
            $_SESSION['coupon_id'] = $couponId;
            $couponStatus = 1;
            if ($couponQuantity == 0) {
                $couponStatus = 0;
            }
            $_SESSION['coupon_status'] = $couponStatus;

            echo $discount;
        } else {
            echo 0;
        }
    }

    public function proceedToCheckout()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $countChooceCart = $_POST['count_chooce'];
            $cartId = [];
            for ($i = 1; $i <= $countChooceCart; $i++) {
                if (isset($_POST['cart' . $i])) {
                    $cartId[] = $_POST['cart' . $i];
                }
            }

            $this->model = $this->model('CartModel');
            $dataCart = $this->model('CartModel');

            $dataCheckout = [];
            foreach ($cartId as $item) {
                $dataCheckout[] = $dataCart->getCheckout($item);
            }

            $_SESSION['checkout'] = $dataCheckout;

            $_SESSION['checkout_cart_total'] = $_POST['cart_price'];
            $_SESSION['checkout_cart_discount'] = $_POST['cart_discount'];
            $_SESSION['checkout_cart_shipping'] = $_POST['cart_shipping'];
            header('Location: /project_2/cart/checkout');
        }
    }
}
