<div class="update-product_show w-100 top-0 bottom-0 end-0 star-0 text-center d-block">
    <div>
        <div class="title position-relative">
            <h5 class="py-3">Information</h5>
            <span class="position-absolute end-0 bottom-0 top-0 d-flex align-items-center h-100">
                <a href="/project_2/Admin/products" class="d-flex align-items-center h-100 text-decoration-none">
                    <h5 class="top-0 bottom-0 end-0 close-update_product m-0 d-flex align-items-center justify-content-center"><i class="fa fa-times" aria-hidden="true"></i></h5>
                </a>
            </span>
        </div>
        <div class="update-product_form">
            <div class="container">
                <div class="row">
                    <?php

                    foreach ($data['product_listid'] as $item) {
                    ?>
                        <div>
                            <input type="text" name="productID" id="" value="<?php echo $item['product_id'] ?>" hidden>
                        </div>
                        <div class="row">
                            <div class="col-3 text-start mb-3 imageContainer">
                                <p>Product image</p>
                                <label for="imageInput">
                                    <img id="previewImage" src="<?php echo "http://localhost/project_2/public/assets/clients/images/" . $item['product_image']; ?>" alt="" style="width: 100px; height:100px;">
                                </label>
                                <br>
                                <input disabled id="imageInput" name="image" type="file" accept="image/jpg" hidden>
                            </div>
                            <div class="col-3 mb-3 text-start imageContainer">
                                <p>Product thumbnail 1</p>
                                <label for="update-product_thumbnail1 imageInput">
                                    <img id="previewImage" src="<?php echo "http://localhost/project_2/public/assets/clients/images/" . $item['product_thumbnail1']; ?>" alt="" style="width: 100px; height:100px;">
                                    <br>
                                    <input disabled id="update-product_thumbnail1 imageInput" name="productthumbnail1" type="file" accept="image/*" hidden>
                            </div>
                            <div class="col-3 mb-3 text-start imageContainer">
                                <p>Product thumbnail 2</p>
                                <label for="update-product_thumbnail2 imageInput">
                                    <img id="previewImage" src="<?php echo "http://localhost/project_2/public/assets/clients/images/" . $item['product_thumbnail2']; ?>" alt="" style="width: 100px; height:100px;">
                                </label><br>
                                <input disabled id="update-product_thumbnail2 imageInput" name="productthumbnail2" type="file" accept="image/*" hidden>
                            </div>
                            <div class="col-3 mb-3 text-start imageContainer">
                                <p>Product thumbnail 3</p>
                                <label for="update-product_thumbnail3 imageInput">
                                    <img id="previewImage" src="<?php echo "http://localhost/project_2/public/assets/clients/images/" . $item['product_thumbnail3']; ?>" alt="" style="width: 100px; height:100px;">
                                </label><br>
                                <input disabled id="update-product_thumbnail3 imageInput" name="productthumbnail3" type="file" accept="image/*" hidden>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3 text-start">
                            <p>Product name</p>
                            <input disabled type="text" placeholder="Product name" name="productname" class="p-2 input-product_name" value="<?php echo $item['product_name']; ?>">
                        </div>
                        <div class="col-lg-4 mb-3 text-start">
                            <p>Product price</p>
                            <input disabled type="text" placeholder="Product price" name="productprice" class="p-2 input-product_price" value="<?php echo $item['product_cost']; ?>">
                        </div>
                        <div class="col-lg-4 mb-3 text-start">
                            <p>Product quantity</p>
                            <input disabled type="text" placeholder="Product discount" name="productdiscount" class="p-2 input-product_discount" value="<?php echo $item['product_quantity']; ?>">
                        </div>
                        <p class="mb-0 text-start button-add_variation mb-4">Product variation</p>
                        <?php
                        $count = 0;
                        foreach ($data['variation_listid'] as $item1) {
                            $count++;
                        ?>
                            <div class="col-12 update-product_variation mb-3">
                                <div class="d-flex justify-content-between variation-add_update mb-3">
                                    <input disabled type="text" name="variation_id<?php echo $count ?>" hidden value="<?php echo $item1['variation_id'] ?>">
                                    <div class="col-4">
                                        <input disabled class="p-1 color-name" type="text" name="colorname<?php echo $count ?>" placeholder="Color" value="<?php echo $item1['color_name'] ?>">
                                    </div>
                                    <div class="col-4">
                                        <input disabled class="p-1 size-name" type="text" name="sizename<?php echo $count ?>" placeholder="Size" value="<?php echo $item1['size_name'] ?>">
                                    </div>
                                    <div class="col-4">
                                        <input disabled class="p-1 variation-quantity" type="number" name="variationquantity<?php echo $count ?>" min="1" placeholder="Quantity" value="<?php echo $item1['variation_quantity'] ?>">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-12 update-product_description mb-3  text-start">
                            <label class="product_description mb-2" for="update-product_description">Product Description</label> <br>
                            <textarea disabled name="productdescribe" id="update-product_description" cols="30" rows="3" class="w-100 p-2">"<?php echo $item['product_describe'] ?>"</textarea>
                        </div>
                </div>
            </div>
        <?php
                    }
        ?>
        </div>
    </div>
</div>
<style>
    .close-update_product {
        color: #fff;
        height: 100%;
        border: 1px solid #009d63;
    }

    .input-product_name,
    .variation-quantity,
    .size-name,
    .color-name,
    .input-product_price,
    .input-product_discount {
        border-radius: 10px;
    }

    .input-product_price,
    .input-product_discount,
    .input-product_name {
        width: 90%;
    }

    .button-add_variation,
    .product_description {
        font-size: larger;
    }
</style>