<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Dashboard</h2>
        </div>
    </nav>
    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2"><?php $count = 0;
                                            foreach ($data['products'] as $product) {
                                                $count++;
                                            }
                                            echo $count; ?></h3>
                        <p class="fs-5">Products</p>
                    </div>
                    <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2"><?php $count = 0;
                                            foreach ($data['products'] as $product) {
                                                $count += $product['product_sold'];
                                            }
                                            echo $count; ?></h3>
                        <p class="fs-5">Sales</p>
                    </div>
                    <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2"><?php $count = 0;
                                            foreach ($data['delivery'] as $delivery) {
                                                $count++;
                                            }
                                            echo $count; ?></h3>
                        <p class="fs-5">Delivery</p>
                    </div>
                    <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <?php if (empty($data['month_ago']) && !empty($data['month_current'])) {
                        ?>
                            <h3 class="fs-2">%100</h3>
                            <p class="fs-5">Increase</p>
                        <?php
                        } elseif (empty($data['month_current']) && empty($data['month_ago'])) {
                        ?>
                            <h3 class="fs-2">%0</h3>
                            <p class="fs-5">constant</p>
                        <?php
                        } elseif (!empty($data['month_current']) && empty($data['month_ago'])) {
                        ?>
                            <h3 class="fs-2">%100</h3>
                            <p class="fs-5">Reduce</p>
                        <?php
                        } else { ?>

                            <h3 class="fs-2"><?php
                                                $countMonthAgo = 0;
                                                foreach ($data['month_ago'] as $dt) {
                                                    $countMonthAgo += $dt['order_price'];
                                                }
                                                $countMonthCurrent = 0;
                                                foreach ($data['month_current'] as $dt) {
                                                    $countMonthCurrent += $dt['order_price'];
                                                }
                                                $change = round((($countMonthCurrent * 100) / $countMonthAgo), 2);
                                                if ($change == 100) {
                                                    echo '%0';
                                                } elseif ($change < 100) {
                                                    echo '%' . 100 - $change;
                                                } else {
                                                    echo '%' . $change - 100;
                                                }
                                                ?></h3>
                            <p class="fs-5"><?php if ($countMonthAgo > $countMonthCurrent) {
                                                echo 'Reduce';
                                            } elseif ($countMonthAgo < $countMonthCurrent) {
                                                echo 'Increase';
                                            } else {
                                                echo 'constant';
                                            } ?></p>
                        <?php } ?>
                    </div>
                    <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <?php if (!empty($data['ordersnew'])) {
            ?>

                <h3 class="fs-4 mb-3">Recent Orders</h3>
                <div class="col">
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">Order date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Price</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['ordersnew'] as $order) {
                            ?>
                                <tr>
                                    <form action="/project_2/admin/orderDetail" method="POST">
                                        <input type="text" hidden value="<?php echo $order['order_id']; ?>" name="order_id">
                                        <th scope="row">#<?php echo $order['order_id'] ?></th>
                                        <td><?php echo $order['order_date'] ?></td>
                                        <td><?php echo $order['customer_name'] ?></td>
                                        <td>$<?php echo $order['order_price'] ?></td>
                                        <td><button type="submit">View</button></td>
                                    </form>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } ?>
        </div>

    </div>
</div>