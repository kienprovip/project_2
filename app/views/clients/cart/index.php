<div class="breadcrumb-section py-5">
    <h2 class="text-center">CART</h2>
    <p class="d-flex justify-content-center"><a href="/project_2/home" class="nav-link">Home</a> > Cart</p>
</div>
<?php if (!empty($data['cart_list'])) {
?>
    <div class="cart my-3">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr class="cart-header">
                            <th class="chooce-product text-center">
                                <div class="py-3">Chooce</div>
                            </th>
                            <th class="cart-image text-center">
                                <div class="py-3">Image</div>
                            </th>
                            <th class="cart-product text-center">
                                <div class="py-3">Product</div>
                            </th>
                            <th class="cart-price text-center">
                                <div class="py-3">Price</div>
                            </th>
                            <th class="cart-quantity text-center">
                                <div class="py-3">Quantity</div>
                            </th>
                            <th class="cart-total text-center">
                                <div class="py-3">Total</div>
                            </th>
                            <th class="cart-manage text-center">
                                <div class="py-3">Delete</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalCart = 0;
                        $countCart = 1;
                        foreach ($data['cart_list'] as $cart) { ?>
                            <form action="">
                                <tr>
                                    <td class="chooce-product text-center">

                                        <input type="checkbox" name="cart<?php echo $countCart ?>" id="chooce-cart<?php echo $countCart ?>" class="name-checkbox checkboxchooce" value="<?php echo $cart['cart_id'] ?>" onchange="syncCheckboxes(this)">

                                        <br><label for="chooce-cart<?php echo $countCart ?>">Chooce</label>
                                    </td>
                            </form>
                            <td class="cart-image text-center p-3">
                                <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $cart['product_image']; ?>" alt="">
                            </td>
                            <td class="cart-product_name text-center">
                                <h6><?php echo $cart['product_name']; ?></h6>
                                <p><?php echo $cart['color_name'] . ', ' . $cart['size_name']; ?></p>
                            </td>
                            <td class="cart-price text-center"><?php echo '$' . number_format($cart['product_current_price'], 2) ?></td>
                            <td class="cart-quantity text-center ">
                                <form action="/project_2/cart/changeQuantity" method="POST">
                                    <button class="minus-variation px-1" name="minus" id="minus-variation_from_cart"><i class='bx bx-minus'></i></button>
                                    <input type="text" name="variation_id" value="<?php echo $cart['variation_id']; ?>" hidden>
                                    <input type="text" name="variation_quantity" value="<?php echo $cart['variation_quantity'] ?>" hidden>
                                    <input type="text" name="product_quantity" value="<?php echo $cart['product_quantity'] ?>" hidden>
                                    <input type="text" name="product_id" value="<?php echo $cart['product_id'] ?>" hidden>
                                    <input type="text" name="cart_id" value="<?php echo $cart['cart_id'] ?>" hidden>
                                    <input type="text" name="cart_quantity" value="<?php echo $cart['cart_quantity']; ?>" hidden>
                                    <input type="text" id="chooce-variation_quantity_from_cart" name="product_quantity_from_cart" class="text-center" value="<?php echo $cart['cart_quantity']; ?>" disabled>
                                    <button class="plus-variation px-1" name="plus" id="plus-variation_from_cart"><i class='bx bx-plus'></i></button>
                                </form>
                            </td>
                            <td class="cart-total text-center"><?php $total =  $cart['cart_quantity'] * $cart['product_current_price'];
                                                                echo '$' . number_format($total, 2) ?></td>
                            <input type="text" name="price<?php echo $countCart ?>" value="<?php echo $total =  $cart['cart_quantity'] * $cart['product_current_price']; ?>" hidden>
                            <td class="cart-delete text-center">
                                <form action="/project_2/cart/deleteOne" method="POST">
                                    <input type="text" name="cart_id" value="<?php echo $cart['cart_id'] ?>" hidden>
                                    <input type="text" name="cart_quantity" value="<?php echo $cart['cart_quantity'] ?>" hidden>
                                    <input type="text" name="product_id" value="<?php echo $cart['product_id'] ?>" hidden>
                                    <input type="text" name="variation_id" value="<?php echo $cart['variation_id'] ?>" hidden>
                                    <button class="deleteOne-from_cart"><i class='bx bx-x fw-bold'></i> <br> Delete</button>
                                </form>
                            </td>
                            </tr>
                            <?php $totalCart += ($cart['cart_quantity'] * $cart['product_current_price']); ?>
                        <?php
                            $countCart++;
                        }
                        ?>
                        <tr class="all-cart_manage">
                            <td class="chooce-product text-center py-3"><input type="checkbox" id="selectAllCart"> <br> <label for="selectAllCart">Chooce all</label>
                            </td>
                            <td class="cart-image text-center py-3"></td>
                            <td class="cart-product text-centerpy-3"></td>
                            <td class="cart-price text-center py-3"></td>
                            <td class="cart-quantity text-center py-3"></td>
                            <td class="cart-total text-center py-3"></td>
                            <td class="cart-delete text-center py-3">
                                <form action="/project_2/cart/deleteAll" method="POST">
                                    <input type="text" name="cart_id" value="<?php echo $cart['cart_id'] ?>" hidden>
                                    <button class="deleteAll-from_cart"><i class='bx bx-x fw-bold'></i> <br> Delete all</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row cart-total_coupon">
                <div class="col-lg-6 col-12 mt-3">
                    <div class="cart-coupon mb-3">
                        <div class="cart-coupon_title ps-3">
                            <h5 class="m-0 py-3 fw-bold">Coupon</h5>
                        </div>
                        <div class="ps-3 py-5 cart-coupon_content">
                            <p>Enter your coupon code if you have one</p>
                            <form action="couponform">
                                <input class="coupon-code p-1" type="text" id="coupon-code" placeholder="Coupon code" name="coupon-code">
                                <input type="submit" class=" coupon-apply py-1 px-3" value="Apply" id="apply-coupon">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 col-cart mt-3">
                    <div class="cart-total mb-3">
                        <div class="cart-total_title ps-3">
                            <h5 class="m-0 py-3 fw-bold">Cart Total</h5>
                        </div>
                        <div class="cart-total_content">
                            <div class="cart-total_subtotal d-flex justify-content-between ps-3">
                                <p class="title m-0 py-5 fw-bold">Subtotal</p>
                                <p class="price m-0 py-5">$<span id="total-from_cart">0</span>.00</p>
                            </div>
                            <div class="cart-total_offer d-flex justify-content-between ps-3">
                                <p class="title m-0 pb-5 fw-bold">Coupon</p>
                                <p class="price m-0 pb-5">$<span id="coupon-from_cart">0</span>.00</p>
                            </div>
                            <div class="cart-total_shipping d-flex justify-content-between ps-3">
                                <p class="title m-0 pb-5 fw-bold">Shipping</p>
                                <p class="price m-0 pb-5">$<span id="shipping-from_cart">5</span>.00</p>
                            </div>
                            <hr class="m-0 mx-3">
                            <div class="cart-total_total d-flex justify-content-between ps-3">
                                <p class="title py-5 fw-bold">Total</p>
                                <p class="price py-5">$<span id="totalPrice-from_cart">5</span>.00</p>
                            </div>
                            <div class="checkout d-flex justify-content-center mb-5">
                                <div>
                                    <form action="/project_2/Cart/proceedToCheckout" method="POST" id="form-proceed_toCheckout" onsubmit="return validateForm()">
                                        <?php $countCart = 1;
                                        foreach ($data['cart_list'] as $cart) {
                                        ?>
                                            <input class="checkboxchooce" type="checkbox" name="cart<?php echo $countCart ?>" value="<?php echo $cart['cart_id'] ?>" onchange="syncCheckboxes(this)" hidden>
                                        <?php
                                            $countCart++;
                                        } ?>
                                        <input type="text" name="count_chooce" hidden value="<?php echo $countCart - 1 ?>">
                                        <input type="text" id="total-from_cartInput" value="0" name="cart_price" hidden>
                                        <input type="text" id="discount-from_cartInput" value="0" name="cart_discount" hidden>
                                        <input type="text" id="shipping-from_cartInput" value="5" name="cart_shipping" hidden>
                                        <input type="submit" class="py-2 px-3" value="Proceed to checkout">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <h2 class="text-center my-5">Your cart is empty</h2>
<?php
} ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function validateForm() {
        var form2Checkboxes = document.getElementById('form-proceed_toCheckout').querySelectorAll('.checkboxchooce');
        for (var i = 0; i < form2Checkboxes.length; i++) {
            if (form2Checkboxes[i].checked) {
                // At least one checkbox is checked, allow form submission
                return true;
            }
        }

        // No checkbox is checked, prevent form submission
        alert("Please select one Product");
        return false;
    }

    function syncCheckboxes(checkbox) {
        var name = checkbox.name;
        var checkboxes = document.querySelectorAll('input[name="' + name + '"]');

        checkboxes.forEach(function(cb) {
            cb.checked = checkbox.checked;
        });
    }
    var nameCheckboxchooce = document.querySelectorAll('.checkboxchooce');
    var totalFromCart = document.getElementById('total-from_cart');
    var couponFromCart = document.getElementById('coupon-from_cart');
    var shippingFromCart = document.getElementById('shipping-from_cart');
    var totalPriceFromCart = document.getElementById('totalPrice-from_cart');
    // Lấy tất cả các checkbox có class 'name-checkbox'
    var nameCheckboxes = document.querySelectorAll('.name-checkbox');

    // Lấy checkbox với id 'selectAll'
    var selectAllCheckbox = document.getElementById('selectAllCart');

    // Thêm sự kiện khi click vào checkbox 'selectAll'
    selectAllCheckbox.addEventListener('change', function() {
        // Duyệt qua tất cả các checkbox với class 'name-checkbox' và thiết lập checked theo giá trị của 'selectAll'
        nameCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
        nameCheckboxchooce.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateTotal();
    });

    // Thêm sự kiện khi click vào bất kỳ checkbox nào có class 'name-checkbox'
    nameCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Kiểm tra xem tất cả các checkbox có class 'name-checkbox' có được chọn hay không
            var allChecked = Array.from(nameCheckboxes).every(function(checkbox) {
                return checkbox.checked;
            });

            // Thiết lập giá trị của 'selectAll' theo kết quả kiểm tra
            selectAllCheckbox.checked = allChecked;
            updateTotal();
        });
    });

    function updateTotal() {
        var total = 0;

        nameCheckboxes.forEach(function(checkbox, index) {
            if (checkbox.checked) {
                var priceInput = document.querySelector('input[name="price' + (index + 1) + '"]');
                total += parseInt(priceInput.value) || 0;
            }
        });

        totalFromCart.textContent = total;
        if (total >= 250) {
            shippingFromCart.textContent = 0;
        }
        couponFromCart.textContent = 0;
        totalPriceFromCart.textContent = parseInt(totalFromCart.textContent) - parseInt(couponFromCart.textContent) + parseInt(shippingFromCart.textContent);
        document.getElementById('total-from_cartInput').value = parseInt(totalFromCart.textContent) - parseInt(couponFromCart.textContent) + parseInt(shippingFromCart.textContent);
        document.getElementById('discount-from_cartInput').value = couponFromCart.textContent;
        document.getElementById('shipping-from_cartInput').value = shippingFromCart.textContent;

    }

    $(document).ready(function() {
        // Xử lý sự kiện khi tỉnh thay đổi
        $("#apply-coupon").click(function(e) {
            e.preventDefault(); // Prevent the form from submitting and the page from reloading

            var selectedCoupon = $("#coupon-code").val(); // Get the entered coupon code
            var total = $("#total-from_cart").text();

            // Sử dụng AJAX để gửi yêu cầu đến server
            $.ajax({
                url: "/project_2/Cart/applyCoupon", // Đường dẫn tới file xử lý ở server
                method: "POST",
                data: {
                    coupon: selectedCoupon,
                    price: total
                },
                success: function(data) {
                    // Hiển thị kết quả từ server
                    $("#discount-from_cartInput").val(data);
                    $("#coupon-from_cart").html(data);
                    $("#total-from_cartInput").val(parseInt(totalFromCart.textContent) + parseInt(shippingFromCart.textContent) - data);
                    $("#totalPrice-from_cart").html(parseInt(totalFromCart.textContent) + parseInt(shippingFromCart.textContent) - data);
                }
            });
        });
    });
</script>