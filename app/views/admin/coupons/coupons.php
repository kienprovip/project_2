<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Coupon</h2>
        </div>
    </nav>
    <div class="container-fluid px-4 position-relative">
        <p class="fs-4 mb-3 show-list-coupon"><span class="click-show-add-button"><i class="fa fa-plus" aria-hidden="true"></i></span></p>
        <div class="row">
            <?php if (!empty($data['coupons'])) { ?>
                <div class="col">
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">Code</th>
                                <th class="text-center" scope="col">Discount price</th>
                                <th class="text-center" scope="col">Quantity</th>
                                <th class="text-center" scope="col">Begining</th>
                                <th class="text-center" scope="col">Finishing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['coupons'] as $coupon) { ?>
                                <tr>
                                    <th scope="row"><?php echo $count; ?></th>
                                    <td><?php echo $coupon['coupon_code'] ?></td>
                                    <td class="text-center"><?php echo $coupon['coupon_price'] ?></td>
                                    <td class="text-center"><?php echo $coupon['coupon_quantity'] ?></td>
                                    <td class="text-center"><?php echo $coupon['coupon_start']; ?></td>
                                    <td class="text-center"><?php echo $coupon['coupon_finish'] ?></td>
                                </tr>
                            <?php $count++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <h3 class="text-center">Coupon is empty!!!</h3>
            <?php } ?>
        </div>
        <div class="px-3 row d-flex justify-content-center align-items-center">
            <div id="show-add-coupon" class="show-add-coupon position-absolute w-100">
                <form action="/project_2/admin/addCoupon" method="POST">
                    <div class="container">
                        <h3 class="py-3 d-flex justify-content-between"><span>Add coupon</span> <span class="kick-add-coupon"><i class="fa fa-times" aria-hidden="true"></i></span></h3>
                        <div class="add-coupon">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <input class="w-100" type="text" name="coupon_code" required placeholder="Code">
                                </div>
                                <div class="col-md-3">
                                    <input class="w-100" type="number" min="1" name="coupon_price" required placeholder="Coupon price">
                                </div>
                                <div class="col-md-3">
                                    <input class="w-100" type="number" min="1" name="bill_minimum" required placeholder="Bill Minimum">
                                </div>
                                <div class="col-md-3">
                                    <input class="w-100" type="number" name="coupon_quantity" required placeholder="Quantity" min="1">
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-6">
                                    <label for="coupon-start">Coupon start</label>
                                    <br>
                                    <input class="w-100" type="datetime-local" name="coupon_start" id="coupon-start" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="coupon-end">Coupon finish</label>
                                    <input class="w-100" type="datetime-local" name="coupon_finish" id="coupon-end" required>
                                </div>
                            </div>
                        </div>
                        <div class="add pb-5">
                            <input type="submit" class="px-5 py-1" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var show = document.querySelector('.show-add-coupon');
    var clickShowAddButton = document.querySelector('.click-show-add-button');
    var showAddButton = document.querySelector('#show-add-coupon');
    var kickAddCoupon = document.querySelector('.kick-add-coupon');
    var clickShowDeleteCoupon = document.querySelector('.click-delete-coupon');
    var showDeleteCoupon = document.querySelector('#show-delete-coupon');
    var kickDeleteShow = document.querySelector('.hide-delete-show');
    clickShowAddButton.addEventListener('click', function() {
        showAddButton.style.display = 'block';
    });
    kickAddCoupon.addEventListener('click', function() {
        showAddButton.style.display = 'none';
    });

    clickShowDeleteCoupon.addEventListener('click', function() {
        showDeleteCoupon.style.display = 'block';
    });
    kickDeleteShow.addEventListener('click', function() {
        showDeleteCoupon.style.display = 'none';
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            // Reset any previous error messages
            clearErrors();

            // Validate coupon code
            var couponCode = document.querySelector('input[name="coupon_code"]').value;
            if (!validateCouponCode(couponCode)) {
                displayError("Coupon code must be 8 characters and alphanumeric.");
                event.preventDefault();
                return;
            }

            // Validate coupon price and bill minimum
            var couponPrice = parseInt(document.querySelector('input[name="coupon_price"]').value);
            var billMinimum = parseInt(document.querySelector('input[name="bill_minimum"]').value);
            if (couponPrice >= billMinimum) {
                displayError("Coupon price must be less than bill minimum.");
                event.preventDefault();
                return;
            }

            // Validate coupon start and finish
            var couponStart = new Date(document.querySelector('input[name="coupon_start"]').value);
            var couponFinish = new Date(document.querySelector('input[name="coupon_finish"]').value);
            var now = new Date();

            if (couponStart <= now || couponFinish <= now || couponStart >= couponFinish) {
                displayError("Coupon start and finish must be in the future, and finish must be after start.");
                event.preventDefault();
                return;
            }
        });

        function validateCouponCode(couponCode) {
            var regex = /^[a-zA-Z0-9]{8}$/;
            return regex.test(couponCode);
        }

        function displayError(message) {
            var errorDiv = document.createElement("div");
            errorDiv.classList.add("text-danger");
            errorDiv.textContent = message;
            document.querySelector(".container").appendChild(errorDiv);
        }

        function clearErrors() {
            var errorDivs = document.querySelectorAll(".text-danger");
            errorDivs.forEach(function(div) {
                div.remove();
            });
        }
    });
</script>