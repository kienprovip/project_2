<?php foreach ($data['product_detail'] as $item) { ?>
    <div class="breadcrumb-section py-5">
        <h2 class="text-center">PRODUCT DETAIL</h2>
        <p class="d-flex justify-content-center"><a href="/project_2/product" class="nav-link">Products</a> > Product detail</p>
    </div>
    <div class="container">
        <div class="product-detail mt-5">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-detail_image text-center">
                        <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_image'] ?>" class="thumbnail-show" alt="">
                    </div>
                    <div class="product-detail_thumbnail d-flex justify-content-center mt-2">
                        <div class="d-flex justify-content-center align-items-center mx-1" onclick="toggleThumbnail0()">
                            <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_image'] ?>" class="thumbnail-image0" alt="">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-1" onclick="toggleThumbnail1()">
                            <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_thumbnail1'] ?>" class="thumbnail-image1" alt="">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-1" onclick="toggleThumbnail2()">
                            <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_thumbnail2'] ?>" class="thumbnail-image2" alt="">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-1" onclick="toggleThumbnail3()">
                            <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_thumbnail3'] ?>" class="thumbnail-image3" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h3 class="product-name"><?php echo $item['product_name'] ?></h3>
                    <div class="product_date me-3">Product date: <?php echo $item['product_date']; ?></div>
                    <div class=" stars-reviews_solds d-flex ">
                        <div class="solds">Sold: <?php echo $item['product_sold']; ?></div>
                        <div class="quantity ms-3">Quantity: <?php echo $item['product_quantity']; ?></div>
                    </div>
                    <div class="product-price d-flex mt-3">
                        <div class="product-cost me-5">
                            <h5><del><?php if ($item['product_discount_price'] !== '0') {
                                            echo $item['product_cost'] . '$';
                                        } ?></del></h5>
                        </div>
                        <div class="product-price me-5">
                            <h3><?php echo $item['product_current_price'] . '$'; ?></h3>
                        </div>
                        <div class="product-discount_percent">
                            <h6 class="px-2"><?php if ($item['product_discount_percent'] !== '0') {
                                                    echo $item['product_discount_percent'] . '% Off';
                                                } ?></h6>
                            <!-- nếu tồn tại giá giảm giá thì ở đây sẽ dùng if để hiển thị giá thành ban đầu và giá sau khi đã giảm giá -->
                        </div>
                    </div>
                    <form action="/project_2/Cart/addToCart" method="POST">
                        <div class="product-variation">
                            <div class="product-color d-flex mt-3">
                                <div class="me-4">Color: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>

                                <?php $colors = explode(',', $item['colors']);
                                foreach ($colors as $color) {
                                    echo '<div class="me-3">
                                <input class="px-2 py-1" type="radio" name="color" value="' . $color . '" id="variation-color_' . $color . '" data-quantity="' . $item['variation_quantity'] . '">
                                <label for="variation-color_' . $color . '">' . $color . '</label>
                            </div>';
                                }
                                ?>
                            </div>
                            <div class="product-size d-flex mt-3">
                                <div class="me-4">Size: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
                                <?php $sizes = explode(',', $item['sizes']);
                                usort($sizes, function ($a, $b) {
                                    $order = array('S', 'M', 'L', 'XL');
                                    return array_search($a, $order) - array_search($b, $order);
                                });
                                foreach ($sizes as $size) {
                                    echo '<div class="me-3">
                                <input class="px-2 py-1" type="radio" name="size" value="' . $size . '" id="variation-size_' . $size . '" data-quantity="' . $item['variation_quantity'] . '">

                                <label for="variation-size_' . $size . '">' . $size . '</label>
                            </div>';
                                }
                                ?>
                            </div>
                            <div class="product-quantity mt-3">
                                <span class="me-4">Quantity: </span>
                                <span class="px-2 minus-variation" style="pointer-events: none;" id="minus-variation"><i class='bx bx-minus'></i></span>
                                <input type="text" value="1" id="chooce-variation_quantity" name="product_quantity" disabled class="text-center">
                                <span class="px-2 plus-variation" style="pointer-events: none;" id="plus-variation"><i class='bx bx-plus'></i></span>
                            </div>
                        </div>
                        <input type="text" name="product_id" hidden value="<?php echo $item['product_id']; ?>">
                        <input type="text" name="product_quantity_current" value="<?php echo $item['product_quantity']; ?>" hidden>
                        <button class="add-to_cart px-5 py-2 mt-5" id="add-to_cartfromproduct_detail" disabled>Add to cart</button>
                    </form>
                </div>
                <div class="product-detail_tablist d-flex justify-content-center my-5">
                    <div class="description-tablist me-3">
                        <button class="px-3 py-1" onclick="toggleDescription()">Description</button>
                    </div>
                    <div class="reviews-tablist ms-3" onclick="toggleReviews()">
                        <button class="px-3 py-1">&nbsp Reviews &nbsp</button>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="description-content">
                        <?php echo $item['product_describe']; ?>
                    </div>
                    <div class="reviews-content">
                        <?php foreach ($data['feedbacks_list'] as $feedback) { ?>
                            <div class="a-content mb-1">
                                <div class="user-information d-flex">
                                    <div class="user-avatar p-3 pb-0 ps-0 pt-0 d-flex justify-content-center align-items-center">
                                        <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $feedback['customer_image'] ?>" alt="">
                                    </div>
                                    <div class="user d-flex align-items-center">
                                        <div class="user-name me-5">
                                            <p class=" fw-bold mb-0"><?php echo $feedback['customer_name'] ?></p>
                                            <p class="mb-0"><?php echo $feedback['feedback_datetime'] ?></p>
                                            <p>Variation: <?php echo $feedback['color_name'] . ', ' . $feedback['size_name'] ?></p>
                                        </div>

                                    </div>

                                </div>
                                <div class="review mb-3">
                                    <?php echo $feedback['feedback_message'] ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var variationQuantity = 1; // Set a default variation quantity
            var variationsList = <?php echo json_encode($data['variations_list']); ?>;
            var colors = <?php echo json_encode($colors); ?>;
            var sizes = <?php echo json_encode($sizes); ?>;

            var colorInputs = document.querySelectorAll('input[name="color"]');
            var sizeInputs = document.querySelectorAll('input[name="size"]');
            var quantityInput = document.getElementById('chooce-variation_quantity');
            var disableAddToCart = document.getElementById('add-to_cartfromproduct_detail');
            var minusButton = document.getElementById('minus-variation');
            var plusButton = document.getElementById('plus-variation');

            function updateSizeOptions(selectedColor) {
                sizeInputs.forEach(function(sizeInput) {
                    sizeInput.disabled = !isOptionAvailable(selectedColor, sizeInput.value, 'color_name', 'size_name');
                });
            }

            function updateColorOptions(selectedSize) {
                colorInputs.forEach(function(colorInput) {
                    colorInput.disabled = !isOptionAvailable(selectedSize, colorInput.value, 'size_name', 'color_name');
                });
            }

            function updateVariationQuantity(selectedColor, selectedSize) {
                for (var i = 0; i < variationsList.length; i++) {
                    if (variationsList[i]['color_name'] == selectedColor && variationsList[i]['size_name'] == selectedSize) {
                        variationQuantity = variationsList[i]['variation_quantity'];
                        break; // Stop the loop once a match is found
                    }
                }
                console.log(variationQuantity);
            }

            function isOptionAvailable(selectedOption, value, optionType1, optionType2) {
                for (var i = 0; i < variationsList.length; i++) {
                    if (variationsList[i][optionType1] == selectedOption && variationsList[i][optionType2] == value) {
                        return true;
                    }
                }
                return false;
            }

            function checkSelection() {
                var selectedColor = document.querySelector('input[name="color"]:checked');
                var selectedSize = document.querySelector('input[name="size"]:checked');
                if (selectedColor && selectedSize) {
                    updateVariationQuantity(selectedColor.value, selectedSize.value);
                    quantityInput.value = 1;
                    quantityInput.disabled = false;
                    disableAddToCart.disabled = false;
                    minusButton.style.pointerEvents = 'auto';
                    plusButton.style.pointerEvents = 'auto';
                } else {
                    quantityInput.value = 1;
                    quantityInput.disabled = true;
                    disableAddToCart.disabled = true;
                    minusButton.style.pointerEvents = 'none';
                    plusButton.style.pointerEvents = 'none';
                }
            }

            colorInputs.forEach(function(colorInput) {
                colorInput.addEventListener('change', function() {
                    updateSizeOptions(colorInput.value);
                    checkSelection();
                });
            });

            sizeInputs.forEach(function(sizeInput) {
                sizeInput.addEventListener('change', function() {
                    updateColorOptions(sizeInput.value);
                    checkSelection();
                });
            });

            minusButton.addEventListener('click', function() {
                var currentValue = parseInt(quantityInput.value) || 1;
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            plusButton.addEventListener('click', function() {
                var currentValue = parseInt(quantityInput.value) || 1;
                if (currentValue < variationQuantity) {
                    quantityInput.value = currentValue + 1;
                }
            });

            quantityInput.addEventListener('input', function() {
                quantityInput.value = quantityInput.value.replace(/\D/g, '');
                var numericValue = parseInt(quantityInput.value) || 1;
                quantityInput.value = Math.min(Math.max(numericValue, 1), variationQuantity);
            });

            // Initial check for selection on page load
            checkSelection();
        });
    </script>

<?php } ?>