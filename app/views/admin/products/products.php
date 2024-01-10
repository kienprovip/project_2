<div id="page-content-wrapper" class="position-relative">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Products</h2>
        </div>
    </nav>
    <div class="container-fluid px-4">
        <div class="row">
            <div>
                <p class="text-end"><span class="click-add_product px-2 py-1">Add product</span></p>
                <div class="col">
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col" class="text-center">Price</th>
                                <th class="text-center" scope="col">Operation</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            foreach ($data['product_list'] as $item) {
                            ?>
                                <tr>
                                    <th scope="row">
                                        <?php
                                        echo $count;
                                        ?>
                                    </th>
                                    <td scope="row"><?php echo $item['product_id'] ?></td>
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td class="text-center"><?php echo $item['product_cost'] ?></td>
                                    <td>
                                        <div class="text-center justify-content-center d-flex">
                                            <span class="me-2 click-delete_product">
                                                <form action="/project_2/admin/deleteProduct" method="POST">
                                                    <input type="text" name="product_idD" value="<?php echo $item['product_id'] ?>" hidden>
                                                    <button class="check-delete-product"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                </form>
                                            </span>
                                            <form action="/project_2/Admin/updateproduct" method="POST">
                                                <input type="hidden" name="productId" value="<?php echo $item['product_id'] ?>">
                                                <button class="update-product-button" type="">
                                                    <span class="ms-2 click-update_product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></button>
                                            </form>
                                            <form action="/project_2/Admin/productdetail" method="POST">
                                                <input type="hidden" name="productId" value="<?php echo $item['product_id'] ?>">
                                                <button class="check-infor-product"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($item['product_status'] == 1) {
                                            echo 'Instock';
                                        } else {
                                            echo 'Sold off';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute w-100 top-0 bottom-0 start-0 end-0 add-product_show">
        <div>
            <div class="title position-relative">
                <h5 class="text-center py-3">Add product</h5>
                <h5 class="position-absolute top-0 bottom-0 end-0 close-add_product d-flex justify-content-center align-items-center"><i class="fa fa-times" aria-hidden="true"></i></h5>
            </div>
            <div class="add-product_form pb-3">
                <form action="addProduct" method="POST">
                    <?php $_SESSION['variation_quantity'] = 1 ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <input type="text" placeholder="Product name" name="productname" class="p-2 input-product_name">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" placeholder="Product price" name="productprice" class="p-2 input-product_price">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="add-product_categorry">Product category</label>
                                <select name="categoryid" id="add-product_categorry" required>
                                    <option value="" selected hidden>Chooce one</option>
                                    <?php foreach ($data['category_list'] as $item) : ?>
                                        <option value="<?php echo $item['category_id']; ?>"><?php echo $item['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 add-product_variation mb-3">
                                <p class="mb-0">Product variation <span class="button-add_variation ms-1"><i class="fa fa-plus" aria-hidden="true"></i></span></p>
                                <div class="variations-container mb-3">
                                    <div class="d-flex justify-content-between variation-add mb-3">
                                        <input type="text" name="colorname1" placeholder="Color" class="p-1" required>
                                        <input type="text" name="sizename1" placeholder="Size" class="p-1">
                                        <input type="text" name="variationquantity1" placeholder="Quantity" class="p-1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 add-product_description mb-3">
                                <label for="add-product_description">Product Description</label> <br>
                                <textarea name="productdescribe" id="add-product_description" cols="30" rows="3" class="w-100 p-2"></textarea>
                            </div>
                            <div class="col-12 text-center add-product_submit"><input type="submit" value="Add now" class="px-3 py-1"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>