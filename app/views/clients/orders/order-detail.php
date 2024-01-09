<?php foreach ($data['orders'] as $order) { ?>
    <div class="breadcrumb-section py-5">
        <h2 class="text-center">ORDER DETAIL</h2>
        <p class="d-flex justify-content-center"><a href="/project_2/orders" class="nav-link">Orders</a> > Order detail</p>
    </div>
    <div class="orderDetail mb-3">
        <div class="container">
            <div class="order-address mt-2">
                <h5 class="order-address_title py-3 ps-3 mb-0"><i class='bx bx-map'></i> Delivery address</h5>
                <div class="order-address_content">
                    <p class="px-3 pt-3">Name: <?php echo $order['customer_name']; ?></p>
                    <p class="px-3">Phone: <?php echo $order['customer_phone']; ?></p>
                    <p class="px-3">Address: <?php echo $order['customer_address']; ?></p>
                    <p class="px-3"><?php if (!empty($order['order_note'])) {
                                        echo 'Note: ' . $order['order_note'];
                                    } ?></p>
                </div>
            </div>
            <div class="mt-5">
                <div class="infor-product">
                    <div class="infor-product_title">
                        <h5 class="py-3 px-3 mb-0"><i class='bx bx-shopping-bag'></i> The order</h5>
                    </div>
                    <div class="infor-product_content">
                        <div class="row m-0">
                            <?php foreach ($data['orderdetail'] as $detail) { ?>
                                <div class="product-image col-2 mt-3 px-3">
                                    <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $detail['product_image']; ?>" alt="">
                                </div>
                                <div class="information-product col-10 mt-3 px-3">
                                    <p class="name-product fw-bold"><?php echo $detail['product_name'] ?></p>
                                    <div class="variation d-flex">
                                        <p class="color me-3">Color: <?php echo $detail['color_name'] ?></p>
                                        <p class="size me-3">Size: <?php echo $detail['size_name']; ?></p>
                                        <p class="quantity me-3">Quantity: <?php echo $detail['product_quantity']; ?></p>
                                    </div>
                                    <div class="price d-flex">
                                        <p class="mb-0">Price:</p>
                                        <p class="mb-0 ms-3"><?php echo $detail['orderdetail_total'] ?></p>
                                    </div>
                                    <?php
                                    $countFeedback = 0;
                                    foreach ($data['feedbacks'] as $feedback) { ?>
                                        <?php if ($order['order_status'] == 3 && $feedback['orderdetail_id'] == $detail['orderdetail_id'] && $feedback['customer_id'] == $_SESSION['customer'][0]) { ?>
                                            <div>Your feedback: <?php echo $feedback['feedback_message'] ?></div>
                                        <?php $countFeedback++;
                                        }
                                        ?>

                                    <?php
                                    }
                                    if ($order['order_status'] == 1 || $order['order_status'] == 2) {
                                        $countFeedback = 1;
                                    } ?>
                                    <?php if ($countFeedback == 0) {
                                    ?>
                                        <div class="feedback-content my-3">
                                            <form action="/project_2/orders/feedbackOrder" method="POST">
                                                <input type="text" name="order_id" value="<?php echo $order['order_id'] ?>" hidden>
                                                <input type="text" name="orderdetail_id" value="<?php echo $detail['orderdetail_id'] ?>" hidden>
                                                <input type="text" name="variation_id" value="<?php echo $detail['variation_id']; ?>" hidden>
                                                <input type="text" name="product_id" value="<?php echo $detail['product_id'] ?>" hidden>
                                                <label for="feedbackcontent">Message</label>
                                                <textarea class="w-100 p-2" name="feedback-content" id="feedbackcontent" cols="30" rows="2" required></textarea>
                                                <div class="text-end"><button class="px-3 py-1">Send</button></div>
                                            </form>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mx-3 px-3 mb-3 py-1 total d-flex justify-content-between">
                                    <p class="mb-0 pb mb-0 py-1-0 fw-bold">Discount </p>
                                    <p class="mb-0 pb-0 fw-bold"><?php echo $order['discount_price']; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mx-3 px-3 mb-3 py-1 total d-flex justify-content-between">
                                    <p class="mb-0 pb mb-0 py-1-0 fw-bold">Shipping </p>
                                    <p class="mb-0 pb-0 fw-bold"><?php echo $order['shipping_price']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="total my-3 mx-3 px-3 py-3 d-flex justify-content-between">
                            <p class="into-money mb-0 fw-bold">Total</p>
                            <p class="price-total mb-0 fw-bold"><?php echo $order['order_price']; ?></p>
                        </div>
                        <div class="time-order mx-3 px-3 py-3 d-flex justify-content-between">
                            <p class="order">Time order</p>
                            <p class="time"><?php echo $order['order_date']; ?></p>
                        </div>
                        <div class="time-delivery mx-3 px-3 pb-3 d-flex justify-content-between">
                            <p class="order">Status</p>
                            <p class="time fw-bold"><?php if ($order['order_status'] == 0) {
                                                        echo 'Canceled';
                                                    } elseif ($order['order_status'] == 1) {
                                                        echo 'Processing';
                                                    } elseif ($order['order_status'] == 2) {
                                                        echo 'Shipping';
                                                    } elseif ($order['order_status'] == 3) {
                                                        echo 'Delivary date: ' . $order['delivery_date'];;
                                                    } ?></p>
                        </div>
                        <div class="cancel-contact mb-3 d-flex justify-content-center justify-content-sm-end px-3">
                            <div>
                                <?php if ($order['order_status'] == 1) {
                                    echo '<form action="/project_2/orders/deleteOrder" method="POST">
        <input type="text" name="order_id" value="' . $order["order_id"] . '" hidden>
        <button class="ms-3 px-3 py-1" name = "sendDeleteOrder">Cancel</button>
      </form>';
                                } elseif ($order['order_status'] == 2) {
                                    echo '<form action="/project_2/orders/receivedOrder" method="POST">
        <input type="text" name="order_id" value="' . $order["order_id"] . '" hidden>
        <button class="ms-3 px-3 py-1" name = "sendReceivedOrder">Received</button>
      </form>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>