<div class="breadcrumb-section py-5">
    <h2 class="text-center">CHECKOUT</h2>
    <p class="d-flex justify-content-center"><a href="/project_2/cart" class="nav-link">Cart</a> > Checkout</p>
</div>
<?php if (isset($_SESSION['checkout'])) { ?>
    <form action="/project_2/Orders/addOrder" method="POST" class=" mt-5">
        <div class="container">
            <div class="checkout">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="billing-details mb-3">
                            <div class="billing-details_title p-2 d-flex align-items-center">
                                <h4 class="mb-0">Billing details</h4>
                            </div>
                            <div class="billing-details_name d-lg-flex justify-content-between">
                                <div class="first-name mt-3">
                                    <label for="billing-details_firstName">First name *</label>
                                    <br>
                                    <input required type="text" name="first-name" id="billing-details_firstName" class="px-1 py-1 w-100">
                                </div>
                                <div class="last-name mt-3">
                                    <label for="billing-details_lastName">Last name *</label>
                                    <br>
                                    <input type="text" name="last-name" id="billing-details_lastName" required class="px-1 py-1 w-100">
                                </div>
                            </div>
                            <div class="d-lg-flex justify-content-between">

                                <div class="billing-details_city mt-3">
                                    <label for="billing-details_city">Tỉnh/Thành phố *</label>
                                    <br>
                                    <select required name="city-province" id="billing-details_city" class="w-100 text-center py-1" onchange="getDistrict()">
                                        <?php foreach ($data['provinces'] as $province) { ?>
                                            <option value="" selected hidden></option>
                                            <option value="<?php echo $province['province_id']; ?>" class="py-1"><?php echo $province['province_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="billing-details_district mt-3">
                                    <label for="billing-details_district">Quận/Huyện *</label>
                                    <br>
                                    <select required name="district" id="billing-details_district" class="w-100 text-center py-1" onchange="getWard()">

                                    </select>
                                </div>

                                <div class="billing-details_ward mt-3">
                                    <label for="billing-details_ward">Phường/Xã *</label>
                                    <br>
                                    <select required name="ward" id="billing-details_ward" class="w-100 text-center py-1">

                                    </select>
                                </div>

                            </div>
                            <div class="billing-details_specificAddress mt-3">
                                <label for="billing-details_specificAddress">Specific Address *</label>
                                <br>
                                <input type="text" name="specific-address" required id="billing-details_specificAddress" class="w-100 px-1 py-1">
                            </div>
                            <div class="billing-details_phoneMail d-lg-flex justify-content-between">
                                <div class="phone mt-3">
                                    <label for="billing-details_phone">Phone *</label>
                                    <br>
                                    <input type="text" name="phone-number" required id="billing-details_phone" class="w-100 p-1">
                                </div>
                                <div class="mail mt-3">
                                    <label for="billing-details_mail">Email address *</label>
                                    <br>
                                    <input type="email" name="email-address" required id="billing-details_mail" class="w-100 p-1">
                                </div>
                            </div>
                            <div class="order-note mt-3">
                                <label for="order-note">Order note</label>
                                <br>
                                <textarea name="order-note" id="order-note" class="w-100 p-1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="your-order mb-3">
                            <div class="your-order_title p-2 d-flex align-items-center">
                                <h4 class="mb-0">Your order</h4>
                            </div>
                            <div class="product-total d-flex justify-content-between">
                                <div class="product">
                                    <div class="product-title py-3 ps-2">Product</div>
                                    <?php foreach ($_SESSION['checkout'] as $item) { ?>
                                        <div class="product-size_quantity ps-2 py-3"><?php echo $item[0]['product_name']; ?> (<?php echo $item[0]['color_name'] . ', ' . $item[0]['size_name']; ?>) <span class="fw-bold">x </span><?php echo $item[0]['cart_quantity']; ?></div>
                                    <?php } ?>
                                    <div class="cart-subtotal ps-2 py-3">Cart subtotal</div>
                                    <div class="offer ps-2 py-3">Offer</div>
                                    <div class="shipping ps-2 py-3">Shipping</div>
                                    <div class="order-total ps-2 py-3">Order total</div>
                                </div>
                                <div class="total">
                                    <div class="total-title py-3 ps-2 py-3">Total</div>
                                    <?php
                                    $total = 0;
                                    foreach ($_SESSION['checkout'] as $item) { ?>
                                        <div class="product-price ps-2 py-3"><?php echo '$' . number_format(($item[0]['product_current_price'] * $item[0]['cart_quantity']), 2); ?></div>
                                    <?php $total += $item[0]['product_current_price'] * $item[0]['cart_quantity'];
                                    } ?>
                                    <div class="cart-subtotal_price ps-2 py-3"><?php echo '$' . number_format($total, 2); ?></div>
                                    <div class="offer-price ps-2 py-3"><?php echo '$' . number_format($_SESSION['checkout_cart_discount'], 2); ?></div>
                                    <div class="shipping-price ps-2 py-3"><?php echo '$' . number_format($_SESSION['checkout_cart_shipping'], 2); ?></div>
                                    <div class="order-total_price ps-2 py-3"><?php echo '$' . number_format($_SESSION['checkout_cart_total'], 2); ?></div>
                                </div>
                            </div>
                            <div class="payment ps-2 mt-3">
                                <input type="radio" name="payment" value="Cash on delivery" required id="order-payment_cash">
                                <label for="order-payment_cash">Cash on delivery</label>
                                <br>
                                <input type="radio" name="payment" value="card" required id="order-payment_card" disabled>
                                <label for="order-payment_card">Pay by card (Comming soon)</label>
                            </div>
                            <div class="submit-payment text-center mt-3">
                                <input type="submit" value="Submit" class="py-2 px-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi tỉnh thay đổi
        $("#billing-details_city").change(function() {
            var selectedTinh = $(this).val();

            // Sử dụng AJAX để gửi yêu cầu đến server
            $.ajax({
                url: "/project_2/Cart/getDistrict", // Đường dẫn tới file xử lý ở server
                method: "POST",
                data: {
                    tinh: selectedTinh
                },
                success: function(data) {
                    // Hiển thị danh sách huyện trong dropdown
                    $("#billing-details_district").html(data);
                }
            });
        });

        // Xử lý sự kiện khi huyện thay đổi
        $("#billing-details_district").change(function() {
            var selectedHuyen = $(this).val();

            // Sử dụng AJAX để gửi yêu cầu đến server
            $.ajax({
                url: "/project_2/Cart/getWard", // Đường dẫn tới file xử lý ở server
                method: "POST",
                data: {
                    huyen: selectedHuyen
                },
                success: function(data) {
                    // Hiển thị danh sách xã trong dropdown
                    $("#billing-details_ward").html(data);
                }
            });
        });
    });
</script>