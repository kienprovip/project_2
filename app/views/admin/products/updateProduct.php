<div class="update-product_show w-100 top-0 bottom-0 end-0 star-0 text-center d-block">
    <div>
        <div class="title">
            <a href="/project_2/Admin/products">
                <h5 class="top-0 bottom-0 end-0 close-update_product"><i class="fa fa-times" aria-hidden="true"></i></h5>
            </a>
            <h5 class="py-5">Update product</h5>
        </div>
        <div class="update-product_form">
            <form action="/project_2/Admin/UpdateProduct" method="POST">
                <div class="container">
                    <div class="row">
                        <?php

                        foreach ($data['product_listid'] as $item) {
                        ?>
                            <div>
                                <input type="text" name="productID" id="" value="<?php echo $item['product_id'] ?>" hidden>
                            </div>
                            <div class="col-12 text-start mb-3 imageContainer">
                                <label for="imageInput">
                                    <img id="previewImage" src="<?php echo "/project_2/public/assets/admin/images/" . $item['product_image']; ?>" alt="" style="width: 100px; height:100px;">
                                </label>
                                <br>
                                <input type="text" hidden name="image" value="<?php echo $item['product_image']; ?>">
                                <input id="imageInput" name="imageUP" type="file" hidden>
                            </div>
                            <div class="col-lg-4 mb-3 text-start">
                                <input type="text" placeholder="Product name" name="productname" class="p-2 input-product_name" value="<?php echo $item['product_name']; ?>">
                            </div>
                            <div class="col-lg-4 mb-3 text-start">
                                <input type="text" placeholder="Product price" name="productprice" class="p-2 input-product_price" value="<?php echo $item['product_cost']; ?>">
                            </div>
                            <div class="col-lg-4 mb-3 text-start">
                                <input type="text" placeholder="Product discount" name="productdiscount" class="p-2 input-product_discount" value="<?php echo $item['product_discount_price']; ?>">
                            </div>
                            <p class="mb-0 text-start  mt-4 mb-4 add_variation">Product variation <span class="button-add_variation ms-1" id="showVariation"><i class="fa fa-plus" aria-hidden="true"></i></span></p>
                            <?php
                            $count = 0;
                            foreach ($data['variation_listid'] as $item1) {
                                $count++;
                            ?>
                                <div class="col-12 update-product_variation mb-3">
                                    <div class="d-flex justify-content-between variation-add_update mb-3">
                                        <input type="text" name="variation_id<?php echo $count ?>" hidden value="<?php echo $item1['variation_id'] ?>">
                                        <div class="col-4 col-lg-4">
                                            <input class="p-1 color-name" type="text" name="colorname<?php echo $count ?>" placeholder="Color" value="<?php echo $item1['color_name'] ?>">
                                        </div>
                                        <div class="col-4 col-lg-4">
                                            <input class=" p-1 size-name" type="text" name="sizename<?php echo $count ?>" placeholder="Size" value="<?php echo $item1['size_name'] ?>">
                                        </div>
                                        <div class="col-4 col-lg-4">
                                            <input class=" p-1 variation-quantity" type="number" name="variationquantity<?php echo $count ?>" min="1" placeholder="Quantity" value="<?php echo $item1['variation_quantity'] ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <input type="text" value="<?php echo  $count ?>" name="count" hidden>
                            <div id="variationsContainer">
                                <!-- Default variation container -->
                                <div class="col-12 insert-product_variation mb-3 d-none" id="variationContainer">
                                    <div class="d-flex justify-content-between variation-add_insert mb-3">
                                        <div class="col-4 col-lg-4">
                                            <input class="p-1 color-name" type="text" name="Icolorname1" placeholder="Color">
                                        </div>
                                        <div class="col-4">
                                            <input class="p-1 size-name" type="text" name="Isizename1" placeholder="Size">
                                        </div>
                                        <div class="col-4">
                                            <input class="p-1 variation-quantity" type="number" name="Ivariationquantity1" placeholder="Quantity" min="1">
                                        </div>
                                        <input type="text" name="countAddVariation" value="1" id="countAddVariation" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 mb-3 text-start imageContainer text-center">
                                    <label for="update-product_thumbnail1 imageInput">
                                        <img id="previewImage" src="<?php echo "/project_2/public/assets/admin/images/" . $item['product_thumbnail1']; ?>" alt="" style="width: 100px; height:100px;">
                                        <br>
                                        <input type="text" name="productthumbnail1" hidden value="<?php echo $item['product_thumbnail1'] ?>">
                                        <input id="update-product_thumbnail1 imageInput" name="productthumbnail1UP" type="file" accept="image/*" hidden>
                                </div>
                                <div class="col-4 mb-3 text-start imageContainer text-center">
                                    <label for="update-product_thumbnail2 imageInput">
                                        <img id="previewImage" src="<?php echo "/project_2/public/assets/admin/images/" . $item['product_thumbnail2']; ?>" alt="" style="width: 100px; height:100px;">
                                    </label><br>
                                    <input type="text" name="productthumbnail2" hidden value="<?php echo $item['product_thumbnail2'] ?>">
                                    <input id="update-product_thumbnail2 imageInput" name="productthumbnail2UP" type="file" accept="image/*" hidden>
                                </div>
                                <div class="col-4 mb-3 text-start imageContainer text-center">
                                    <label for="update-product_thumbnail3 imageInput">
                                        <img id="previewImage" src="<?php echo "/project_2/public/assets/admin/images/" . $item['product_thumbnail3']; ?>" alt="" style="width: 100px; height:100px;">
                                    </label><br>
                                    <input type="text" name="productthumbnail3" hidden value="<?php echo $item['product_thumbnail3'] ?>">
                                    <input id="update-product_thumbnail3 imageInput" name="productthumbnail3UP" type="file" accept="image/*" hidden>
                                </div>
                            </div>
                            <div class="col-12 update-product_description mb-3  text-start">
                                <label class="product_description" for="update-product_description">Product Description</label> <br>
                                <textarea name="productdescribe" id="update-product_description" cols="30" rows="3" class="w-100 p-2">"<?php echo $item['product_describe'] ?>"</textarea>
                            </div>

                    </div>
                </div>
            <?php
                        }
            ?>
            <div class="pb-5">
                <input class="button-update" type="submit" value="Update">
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Get the elements
    $(document).ready(function() {
        var showButton = document.getElementById('showVariation');
        var variationsContainer = document.getElementById('variationsContainer');
        var variationCount = 1;

        // Add click event listener to the button
        showButton.addEventListener('click', function() {
            // Clone the default variation container
            var newVariationContainer = document.getElementById('variationContainer').cloneNode(true);

            // Remove the 'd-none' class from the new container
            newVariationContainer.classList.remove('d-none');

            // Increment the variationCount for the default variation container
            newVariationContainer.querySelectorAll('input').forEach(function(input) {
                input.name = input.name.replace(/\d+$/, variationCount);
            });

            // Append the new container to the variations container
            variationsContainer.appendChild(newVariationContainer);

            // Increment variationCount for the next click
            variationCount++;
            var countAddVariation = document.getElementById('countAddVariation');
            countAddVariation.value = variationCount;
        });

        $(".button-add_variation").on("click", function() {
            // Clone the variation template
            let newVariation = $(".insert-product_variation .variation-add_insert:first").clone();

            // Update names for the cloned variation
            newVariation.find('input').each(function() {
                this.name = this.name.replace(/\d+$/, variationCount);
                this.value = ''; // Clear the input value
            });
        });
    });
</script>
<style>
    .input-product_name,
    .input-product_discount,
    .input-product_price,
    .variation-quantity,
    .size-name,
    .color-name {
        border-radius: 10px;
    }

    .input-product_name,
    .input-product_discount,
    .input-product_price {
        width: 100%;
    }

    .add_variation,
    .product_description {
        font-size: larger;
    }

    .button-add_variation:hover {
        color: #009d63;
        cursor: pointer;
    }

    .button-update {
        background-color: #009d63;
        height: 40px;
        width: 100px;
        border-radius: 10px;
    }

    .button-update:hover {
        background-color: white;
    }

    .close-update_product {
        color: black;
        float: right;
    }

    .close-update_product:hover {
        color: red;
    }
</style>