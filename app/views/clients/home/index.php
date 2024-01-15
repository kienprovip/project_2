<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
            <div class="d-flex justify-content-center">
                <img src="http://localhost/project_2/public/assets/clients/images/show1.png" class="d-block" alt="...">
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <div class="d-flex justify-content-center">
                <img src="http://localhost/project_2/public/assets/clients/images/show2.png.crdownload" class="d-block" alt="...">
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center">
                <img src="http://localhost/project_2/public/assets/clients/images/show3.png" class="d-block" alt="...">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="home-service mt-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 mb-5">
                <div class="image text-center">
                    <img src="http://localhost/project_2/public/assets/clients/images/free-shipping_service.png" alt="">
                </div>
                <div class="content">
                    <div class="title">
                        <h6 class="text-center py-2">Free Shipping</h6>
                    </div>
                    <p class="text-center">Free shipping for order has minimum tatal is $250.00</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-5">
                <div class="image text-center">
                    <img src="http://localhost/project_2/public/assets/clients/images/money-back_service.png" alt="">
                </div>
                <div class="content">
                    <div class="title">
                        <h6 class="text-center py-2">30 Day Money Back</h6>
                    </div>
                    <p class="text-center">100% satisfaction guaranteed, or get your money back within 30 days!</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-5">
                <div class="image text-center">
                    <img src="http://localhost/project_2/public/assets/clients/images/safe-payment_service.png" alt="">
                </div>
                <div class="content">
                    <div class="title">
                        <h6 class="text-center py-2">Safe Payment</h6>
                    </div>
                    <p class="text-center">Pay with the world's most popular and secure payment methods.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-5">
                <div class="image text-center">
                    <img src="http://localhost/project_2/public/assets/clients/images/loyalty-customer_service.png" alt="">
                </div>
                <div class="content">
                    <div class="title">
                        <h6 class="text-center py-2">Loyalty Customer</h6>
                    </div>
                    <p class="text-center">Card for the other 30% of their purchases at a rate of 1% cash back.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="category">
        <div class="row">
            <?php foreach ($data['category_list'] as $item) { ?>
                <div class="col-lg-6 col-12 mb-lg-3">
                    <div class="category-image_big w-100 ">
                        <div class="w-100 d-flex justify-content-center align-items-center position-relative">
                            <div class="position-absolute d-flex align-items-center">
                                <form action="/project_2/product/index" method="POST">
                                    <input type="text" hidden value="1" name="category_id">
                                    <button class="px-5 py-2" name="hoodies">Hoodies</button>
                                </form>
                            </div>
                            <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['category_image'] = 'hoodies_category.png'; ?>" alt="" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <div class="row">
                        <div class="col-md-6 category-image">
                            <div class="w-100 d-flex justify-content-center align-items-center position-relative">
                                <div class="position-absolute d-flex align-items-center">
                                    <form action="/project_2/product/index" method="POST">
                                        <input type="text" hidden value="2" name="category_id">
                                        <button class="px-5 py-2" name="sweater">Sweaters</button>
                                    </form>
                                </div>
                                <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['category_image'] = 'sweater_category.png'; ?>" alt="" width="100%">
                            </div>
                        </div>
                        <div class="col-md-6 category-image">
                            <div class="w-100 d-flex justify-content-center align-items-center position-relative">
                                <div class="position-absolute d-flex align-items-center">
                                    <form action="/project_2/product/index" method="POST">
                                        <input type="text" hidden value="3" name="category_id">
                                        <button class="px-5 py-2" name="shorts">Shorts</button>
                                    </form>
                                </div>
                                <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['category_image'] = 'short_category.png'; ?>" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 category-image">
                            <div class="w-100 d-flex justify-content-center align-items-center position-relative">
                                <div class="position-absolute d-flex align-items-center">
                                    <form action="/project_2/product/index" method="POST">
                                        <input type="text" hidden value="4" name="category_id">
                                        <button class="px-5 py-2" name="t-shirt">T-Shirt</button>
                                    </form>
                                </div>
                                <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['category_image'] = 't-shirt_category.png'; ?>" alt="" width="100%">
                            </div>
                        </div>
                        <div class="col-md-6 category-image">
                            <div class="w-100 d-flex justify-content-center align-items-center position-relative">
                                <div class="position-absolute d-flex align-items-center">
                                    <form action="/project_2/product/index" method="POST">
                                        <input type="text" hidden value="5" name="category_id">
                                        <button class="px-5 py-2" name="pants">Pants</button>
                                    </form>
                                </div>
                                <img src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['category_image'] = 'pants_category.png'; ?>" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                </div>

            <?php break;
            } ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="outstanding-products">
        <h3 class="ml-2 mb-3 mt-2">FEATURE PRODUCTS</h3>
        <div class="row">
            <?php foreach ($data['featureProductList'] as $item) {
            ?>
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <form action="/project_2/product/product_detail" method="POST">
                        <div class="card product position-relative">
                            <div class="position-absolute d-flex justify-content-between top-0 start-0 end-0">
                                <div class="discount px-1">
                                    <i class='bx bx-trending-down'></i><?php echo $item['product_discount_percent'] . '%' ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center product_image">
                                <img class="card-img-top" src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_image']; ?>" alt="Card image">
                            </div>
                            <div class="card-body position-relative">
                                <div class="card-content">
                                    <input type="text" value="<?php $item['product_id']; ?>" hidden name="product_id">
                                    <p class="card-title text-center fw-bold"><?php echo $item['product_name']; ?></p>
                                    <p class="card-text text-center fw-bold"><?php echo '$' . number_format($item['product_current_price'], 2); ?></p>
                                </div>
                                <div class="buy-detail d-none justify-content-center position-absolute top-0 bottom-0 start-0 end-0">
                                    <div class="detail ms-2 d-flex align-items-center">
                                        <input type="text" hidden value="<?php echo $item['product_id']; ?>" name="product_id">
                                        <button class="p-2"><i class='bx bx-menu d-flex justify-content-center align-items-center'></i></button>
                                    </div>
                                </div>
                            </div>
                            <p class="position-absolute bottom-0 end-0 mb-0 text-center pe-1 pb-1" style="font-size: 10px;">Sold: <?php echo $item['product_sold']; ?></p>
                        </div>
                    </form>
                </div>
            <?php } ?>

        </div>
        <div class="show-more text-center">
            <form action="/project_2/product/index" method="POST">
                <input type="text" name="group_by" value="product_sold" hidden>
                <button>Show more...</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="best-seller">
        <h3 class="ml-2 mb-3 mt-2">FLASH SALES</h3>
        <div class="row">
            <?php foreach ($data['flashSaleList'] as $item) {
            ?>
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <form action="/project_2/product/product_detail" method="POST">
                        <div class="card product position-relative">
                            <div class="position-absolute d-flex justify-content-between top-0 start-0 end-0">
                                <div class="discount px-1">
                                    <i class='bx bx-trending-down'></i><?php echo $item['product_discount_percent'] . '%' ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center product_image">
                                <img class="card-img-top" src="http://localhost/project_2/public/assets/clients/images/<?php echo $item['product_image']; ?>" alt="Card image">
                            </div>
                            <div class="card-body position-relative">
                                <div class="card-content">
                                    <input type="text" value="<?php $item['product_id']; ?>" hidden name="product_id">
                                    <p class="card-title text-center fw-bold"><?php echo $item['product_name']; ?></p>
                                    <p class="card-text text-center fw-bold"><?php echo '$' . number_format($item['product_current_price'], 2); ?></p>
                                </div>
                                <div class="buy-detail d-none justify-content-center position-absolute top-0 bottom-0 start-0 end-0">

                                    <div class="detail ms-2 d-flex align-items-center">
                                        <input type="text" hidden value="<?php echo $item['product_id']; ?>" name="product_id">
                                        <button class="p-2"><i class='bx bx-menu d-flex justify-content-center align-items-center'></i></button>
                                    </div>
                                </div>
                            </div>
                            <p class="position-absolute bottom-0 end-0 mb-0 text-center pe-1 pb-1" style="font-size: 10px;">Sold: <?php echo $item['product_sold']; ?></p>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
        <div class="show-more text-center">
            <form action="/project_2/product/index" method="POST">
                <input type="text" name="group_by" value="product_discount_percent" hidden>
                <button>Show more...</button>
            </form>
        </div>
    </div>
</div>