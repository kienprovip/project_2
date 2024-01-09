<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Orders</h2>
        </div>
    </nav>
    <div class="orders mt-5 w-100">
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
                                    <th>Customer</th>
                                    <th>Price</th>
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
                                        <td class="py-3"><?php echo $order['customer_name']; ?></td>
                                        <td class="py-3"><?php echo $order['order_price'] ?></td>
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
                                            <form action="/project_2/admin/orderDetail" method="POST">
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
                        <h4 class="text-center mb-5">Order is empty</h4>
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
                                            <form action="/project_2/admin/orderDetail" method="POST">
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
                        <h4 class="text-center mb-5"> Processing order is empty</h4>
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
                                            <form action="/project_2/admin/orderDetail" method="POST">
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
                        <h4 class="text-center mb-5">Shipping order is empty</h4>
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
                                            <form action="/project_2/admin/orderDetail" method="POST">
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
                        <h4 class="text-center mb-5">Deliveried order is empty</h4>
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
                                            <form action="/project_2/admin/orderDetail" method="POST">
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
                        <h4 class="text-center mb-5">Canceled order is empty</h4>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var AllOrdersElement = document.querySelector('.all-orders-content');
    var ShippingOrdersEmement = document.querySelector('.shipping-orders-content');
    var DeliveriedOrdersEmement = document.querySelector('.deliveried-orders-content');
    var ProcessingOrdersElement = document.querySelector('.processing-orders-content');
    var CanceledOrdersElement = document.querySelector('.canceled-orders-content');

    function toggleAllOrders() {
        if (AllOrdersElement.style.display === 'none') {
            ShippingOrdersEmement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'block';
        } else {
            AllOrdersElement.style.display = 'block';
            DeliveriedOrdersEmement.style.display = 'none';
            ShippingOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
        }
    }

    function toggleShippingOrders() {
        if (ShippingOrdersEmement.style.display === 'none') {
            ShippingOrdersEmement.style.display = 'block';
            DeliveriedOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
        } else {
            ShippingOrdersEmement.style.display = 'block';
            DeliveriedOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
        }
    }

    function toggleBeingProcessed() {
        if (DeliveriedOrdersEmement.style.display === 'none') {
            ShippingOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'block';
            DeliveriedOrdersEmement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
        } else {
            ShippingOrdersEmement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'block';
            AllOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
        }
    }

    function toggleDeliveriedOrders() {
        if (DeliveriedOrdersEmement.style.display === 'none') {
            ShippingOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'block';
            AllOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
        } else {
            ShippingOrdersEmement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'block';
            ProcessingOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'none';
        }
    }

    function toggleCanceledOrders() {
        if (CanceledOrdersElement.style.display === 'none') {
            ShippingOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'block';
        } else {
            ShippingOrdersEmement.style.display = 'none';
            DeliveriedOrdersEmement.style.display = 'none';
            ProcessingOrdersElement.style.display = 'none';
            AllOrdersElement.style.display = 'none';
            CanceledOrdersElement.style.display = 'block';
        }
    }
</script>