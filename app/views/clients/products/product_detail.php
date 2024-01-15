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
                    <h3 class="product-name fw-bold"><?php echo $item['product_name'] ?></h3>
                    <div class="stars-reviews_solds">
                        <div class="solds">Sold: <span><?php echo $item['product_sold']; ?></span></div>
                        <div class="quantity">Quantity: <span id="product_quantity_change"><?php echo $item['product_quantity']; ?></span></div>
                    </div>
                    <div class="product-price d-flex mt-3">

                        <div class="product-price me-3">
                            <h3 class="mb-0 fw-bold"><?php echo '$' . number_format($item['product_current_price'], 2); ?></h3>
                        </div>


                    </div>
                    <form action="/project_2/Cart/addToCart" method="POST">
                        <div class="product-variation mt-3">
                            <div class="d-flex">
                                <div class="me-4">Variation:&nbsp</div>
                                <div class="d-flex flex-wrap">
                                    <?php foreach ($data['variations_list'] as $variation) { ?>
                                        <?php if ($variation['variation_quantity'] == 0) {
                                        ?>
                                            <div class="mb-3">
                                                <label class="variation-choice_detail-disable px-3 py-1 me-3" for="variation<?php echo $variation['variation_id'] ?>">
                                                    <input hidden disabled type="radio" id="variation<?php echo $variation['variation_id'] ?>" name="variation_id" value="<?php echo $variation['variation_id'] ?>" onclick="updateBackgroundColor(this)">
                                                    <?php echo $variation['color_name'] . ' - ' . $variation['size_name'] ?>
                                                </label>
                                            </div>
                                        <?php
                                        } else { ?>
                                            <div class="mb-3">
                                                <label class="variation-choice_detail px-3 py-1 me-3" for="variation<?php echo $variation['variation_id'] ?>">
                                                    <input hidden type="radio" id="variation<?php echo $variation['variation_id'] ?>" name="variation_id" value="<?php echo $variation['variation_id'] ?>" onclick="updateBackgroundColor(this)">
                                                    <?php echo $variation['color_name'] . ' - ' . $variation['size_name'] ?>
                                                </label>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                            <div class="product-quantity my-3">
                                <span class="me-4">Quantity: </span>
                                <span class="px-2 minus-variation" style="pointer-events: none;" id="minus-variation"><i class='bx bx-minus'></i></span>
                                <input type="text" value="1" id="chooce-variation_quantity" name="product_quantity" disabled class="text-center">
                                <span class="px-2 plus-variation" style="pointer-events: none;" id="plus-variation"><i class='bx bx-plus'></i></span>
                            </div>
                        </div>
                        <input type="text" name="product_id" hidden value="<?php echo $item['product_id']; ?>">
                        <input type="text" name="product_quantity_current" value="<?php echo $item['product_quantity']; ?>" hidden>
                        <div class="d-flex justify-content-center d-lg-block">
                            <span class="d-none d-lg-inline-block">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                            <button class="add-to_cart px-5 py-2 mt-3" id="add-to_cartfromproduct_detail" disabled>Add to cart</button>
                        </div>
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
        function updateBackgroundColor(checkbox) {
            var checkboxes = document.getElementsByName('variation_id');

            // Xóa lớp CSS "selected" từ tất cả các checkbox
            checkboxes.forEach(function(otherCheckbox) {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.parentElement.classList.remove('selected');
                }
            });

            // Nếu checkbox này được chọn, thêm lớp CSS "selected"
            if (checkbox.checked) {
                checkbox.parentElement.classList.add('selected');
            } else {
                // Nếu checkbox này không được chọn, xóa lớp CSS "selected"
                checkbox.parentElement.classList.remove('selected');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            var variationQuantity = 1; // Set a default variation quantity
            var variationsList = <?php echo json_encode($data['variations_list']); ?>;

            var variationInputs = document.querySelectorAll('input[name="variation_id"]');
            var quantityInput = document.getElementById('chooce-variation_quantity');
            var disableAddToCart = document.getElementById('add-to_cartfromproduct_detail');
            var minusButton = document.getElementById('minus-variation');
            var plusButton = document.getElementById('plus-variation');


            function updateVariationQuantity(selectedVariation) {
                for (var i = 0; i < variationsList.length; i++) {
                    if (variationsList[i]['variation_id'] == selectedVariation) {
                        variationQuantity = variationsList[i]['variation_quantity'];
                        document.getElementById("product_quantity_change").textContent = variationQuantity;
                        break; // Stop the loop once a match is found
                    }
                }
            }



            function checkSelection() {
                var selectedVatiation = document.querySelector('input[name="variation_id"]:checked');
                if (selectedVatiation) {
                    updateVariationQuantity(selectedVatiation.value);
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

            variationInputs.forEach(function(colorInput) {
                colorInput.addEventListener('change', function() {
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