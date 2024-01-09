<div class="breadcrumb-section py-5">
    <h2 class="text-center">PRODUCTS</h2>
    <p class="d-flex justify-content-center"><a href="/project_2/home" class="nav-link">Home</a> > Orders</p>
</div>
<div class="orders mt-5">
    <div class="container">
        <?php if (!empty($data['orders'])) { ?>
            <div class="orders-tablist d-flex justify-content-center">
                <div class="all-orders me-1">
                    <button class="py-1 px-3" onclick="toggleAllOrders()">All</button>
                </div>
                <div class="being-processed me-1">
                    <button class="py-1 px-1" onclick="toggleBeingProcessed()">Processing</button>
                </div>
                <div class="shipping-orders me-1">
                    <button class="py-1 px-1" onclick="toggleShippingOrders()">Shipping</button>
                </div>
                <div class="deliveried-orders me-1">
                    <button class="py-1 px-1" onclick="toggleDeliveriedOrders()">Deliveried</button>
                </div>
                <div class="canceled-orders me-1">
                    <button class="py-1 px-1" onclick="toggleCanceledOrders()">Canceled</button>
                </div>
            </div>
        <?php } ?>
        <div class="orders-content mt-3">
            <div class="all-orders-content w-100 ">
                <?php if (!empty($data['orders'])) { ?>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order date</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['orders'] as $order) {
                            ?>
                                <tr>
                                    <td class="py-3">#<?php echo $order['order_id']; ?></td>
                                    <td class="py-3"><?php echo $order['order_date']; ?></td>
                                    <td class="py-3"><?php echo $order['order_pay']; ?></td>
                                    <td class="py-3"><?php if ($order['order_status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif ($order['order_status'] == 2) {
                                                            echo 'Shipping';
                                                        } elseif ($order['order_status'] == 3) {
                                                            echo 'Deliveried';
                                                        } elseif ($order['order_status'] == 0) {
                                                            echo 'Canceled';
                                                        } ?></td>
                                    <td class="py-3 view-order_detail">
                                        <form action="/project_2/orders/orderdetail" method="POST">
                                            <input type="text" name="order_id" value="<?php echo $order['order_id']; ?>" hidden>
                                            <button class="px-3"><i class='bx bx-show'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h4 class="text-center mb-5">Your order is empty</h4>
                <?php
                } ?>
            </div>
            <div class="processing-orders-content">
                <?php if (!empty($data['processing'])) { ?>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order date</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['processing'] as $order) {
                            ?>
                                <tr>
                                    <td class="py-3">#<?php echo $order['order_id']; ?></td>
                                    <td class="py-3"><?php echo $order['order_date']; ?></td>
                                    <td class="py-3"><?php echo $order['order_pay']; ?></td>
                                    <td class="py-3"><?php if ($order['order_status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif ($order['order_status'] == 2) {
                                                            echo 'Shipping';
                                                        } elseif ($order['order_status'] == 3) {
                                                            echo 'Deliveried';
                                                        } elseif ($order['order_status'] == 0) {
                                                            echo 'Canceled';
                                                        } ?></td>
                                    <td class="py-3 view-order_detail">
                                        <form action="/project_2/orders/orderdetail" method="POST">
                                            <input type="text" name="order_id" value="<?php echo $order['order_id']; ?>" hidden>
                                            <button class="px-3"><i class='bx bx-show'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h4 class="text-center mb-5">Your processing order is empty</h4>
                <?php
                } ?>
            </div>
            <div class="shipping-orders-content w-100">
                <?php if (!empty($data['shipping'])) { ?>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order date</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['shipping'] as $order) {
                            ?>
                                <tr>
                                    <td class="py-3">#<?php echo $order['order_id']; ?></td>
                                    <td class="py-3"><?php echo $order['order_date']; ?></td>
                                    <td class="py-3"><?php echo $order['order_pay']; ?></td>
                                    <td class="py-3"><?php if ($order['order_status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif ($order['order_status'] == 2) {
                                                            echo 'Shipping';
                                                        } elseif ($order['order_status'] == 3) {
                                                            echo 'Deliveried';
                                                        } elseif ($order['order_status'] == 0) {
                                                            echo 'Canceled';
                                                        } ?></td>
                                    <td class="py-3 view-order_detail">
                                        <form action="/project_2/orders/orderdetail" method="POST">
                                            <input type="text" name="order_id" value="<?php echo $order['order_id']; ?>" hidden>
                                            <button class="px-3"><i class='bx bx-show'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h4 class="text-center mb-5">Your shipping order is empty</h4>
                <?php
                } ?>
            </div>
            <div class="deliveried-orders-content w-100">
                <?php if (!empty($data['deliveried'])) { ?>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order date</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['deliveried'] as $order) {
                            ?>
                                <tr>
                                    <td class="py-3">#<?php echo $order['order_id']; ?></td>
                                    <td class="py-3"><?php echo $order['order_date']; ?></td>
                                    <td class="py-3"><?php echo $order['order_pay']; ?></td>
                                    <td class="py-3"><?php if ($order['order_status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif ($order['order_status'] == 2) {
                                                            echo 'Shipping';
                                                        } elseif ($order['order_status'] == 3) {
                                                            echo 'Deliveried';
                                                        } elseif ($order['order_status'] == 0) {
                                                            echo 'Canceled';
                                                        } ?></td>
                                    <td class="py-3 view-order_detail">
                                        <form action="/project_2/orders/orderdetail" method="POST">
                                            <input type="text" name="order_id" value="<?php echo $order['order_id']; ?>" hidden>
                                            <button class="px-3"><i class='bx bx-show'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h4 class="text-center mb-5">Your deliveried order is empty</h4>
                <?php
                } ?>
            </div>
            <div class="canceled-orders-content w-100">
                <?php if (!empty($data['canceled'])) { ?>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order date</th>
                                <th>Payment method</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['canceled'] as $order) {
                            ?>
                                <tr>
                                    <td class="py-3">#<?php echo $order['order_id']; ?></td>
                                    <td class="py-3"><?php echo $order['order_date']; ?></td>
                                    <td class="py-3"><?php echo $order['order_pay']; ?></td>
                                    <td class="py-3"><?php if ($order['order_status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif ($order['order_status'] == 2) {
                                                            echo 'Shipping';
                                                        } elseif ($order['order_status'] == 3) {
                                                            echo 'Deliveried';
                                                        } elseif ($order['order_status'] == 0) {
                                                            echo 'Canceled';
                                                        } ?></td>
                                    <td class="py-3 view-order_detail">
                                        <form action="/project_2/orders/orderdetail" method="POST">
                                            <input type="text" name="order_id" value="<?php echo $order['order_id']; ?>" hidden>
                                            <button class="px-3"><i class='bx bx-show'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h4 class="text-center mb-5">Your canceled order is empty</h4>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>