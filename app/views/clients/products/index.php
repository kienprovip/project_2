<div class="breadcrumb-section py-5">
    <h2 class="text-center">PRODUCTS</h2>
    <p class="d-flex justify-content-center"><a href="/project_2/home" class="nav-link">Home</a> > Products</p>
</div>
<div class="container my-3">
    <div class="row">
        <div class="d-none d-lg-block col-lg-3 pt-5 pt-lg-0">
            <div class="product-filter-lg">
                <form action="/project_2/product/index" method="POST" class="filter-form">
                    <h5 class="product-filter_title text-center pt-3"><i class='bx bx-filter-alt'></i> Filter</h5>
                    <div class="filter-price p-1 mb-3">
                        <p class="text-center pt-3">Price</p>
                        <div class="d-flex justify-content-between">
                            <input type="number" min="0" class="minimum-price mb-3" placeholder="$ Minimum" name="minimum-price">
                            <span class="d-inline-block text-center mb-3">to</span>
                            <input type="number" min="0" class="maximum-price mb-3" placeholder="$ Maximum" name="maximum-price">
                        </div>
                    </div>
                    <div class="filter-arrange">
                        <p class="filter-arrange_title text-center pt-3">Arrange</p>
                        <div class="d-flex justify-content-center">
                            <select class="px-3 py-1" name="arrange">
                                <option selected value="all">All</option>
                                <option value="product_date">Latest</option>
                                <option value="product_sold">Best sell</option>
                                <option value="cheapest">Cheapest</option>
                                <option value="the-most_expensive">The most expensive</option>
                                <option value="biggest-discount">Biggest discount</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-category">
                        <p class="filter-category_title text-center pt-3">Category</p>
                        <div class="d-flex justify-content-center">
                            <select class="px-3 py-1" name="category" id="">
                                <option value="0" selected hidden>All</option>
                                <?php foreach ($data['categories_list'] as $category) {
                                ?>
                                    <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-3 pb-3">
                        <input type="reset" class="reset text-center me-3 py-1 px-2" value="  Reset  ">
                        <input type="submit" class="submit ms-3 py-1 px-2" value=" Submit " name="product-filter">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <div class="products-arrange d-flex justify-content-between align-items-center d-lg-none">
                <div class="arrange-filter d-lg-none h-100 ms-auto">
                    <span onclick="toggleFilter()" class="d-flex w-100 h-100 justify-content-center align-items-center"><i class='bx bx-menu'></i> Filter</span>
                </div>
            </div>
            <div class="products mt-3 position-relative">
                <div class="product-filter-d d-lg-none position-absolute ms-auto">
                    <form action="/project_2/product/index" method="POST" class="filter-form">
                        <h5 class="product-filter_title text-center pt-3"><i class='bx bx-filter-alt'></i> Filter</h5>
                        <div class="filter-price p-1 mb-3">
                            <p class="text-center pt-3">Price</p>
                            <div class="d-flex justify-content-between">
                                <input type="number" min="0" class="minimum-price mb-3" placeholder="$ Minimum" name="minimum-price">
                                <span class="d-inline-block text-center mb-3">to</span>
                                <input type="number" min="0" class="maximum-price mb-3" placeholder="$ Maximum" name="maximum-price">
                            </div>
                        </div>
                        <div class="filter-arrange">
                            <p class="filter-arrange_title text-center pt-3">Arrange</p>
                            <div class="d-flex justify-content-center">
                                <select class="px-3 py-1" name="arrange">
                                    <option selected value="all">All</option>
                                    <option value="latest">Latest</option>
                                    <option value="best-sell">Best sell</option>
                                    <option value="cheapest">Cheapest</option>
                                    <option value="the-most_expensive">The most expensive</option>
                                    <option value="biggest-discount">Biggest discount</option>
                                </select>
                            </div>
                        </div>
                        <div class="filter-category">
                            <p class="filter-category_title text-center pt-3" for="filter-category_lg">Category</p>
                            <div class="d-flex justify-content-center">
                                <select class="px-3 py-1" name="category" id="filter-category_lg">
                                    <option hidden selected value="0">All</option>
                                    <?php foreach ($data['categories_list'] as $category) {
                                    ?>
                                        <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-5 mb-3 pb-3">
                            <input type="reset" class="reset text-center me-3 px-3 py-1" value="  Reset  ">
                            <input type="submit" name="product-filter" class="submit ms-3 px-3 py-1" value=" Submit ">
                        </div>
                    </form>
                </div>
                <div class="row">
                    <?php
                    $countProduct = 0;
                    foreach ($data['all_product'] as $prd) {
                        $countProduct++;
                    }
                    foreach ($data['product_list'] as $item) {

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
                                            <p class="card-text text-center fw-bold"><?php echo $item['product_current_price'] . '$'; ?></p>
                                        </div>
                                        <div class="buy-detail d-none justify-content-center position-absolute top-0 bottom-0 start-0 end-0">
                                            <div class="detail ms-2 d-flex align-items-center">
                                                <input type="text" hidden value="<?php echo $item['product_id']; ?>" name="product_id">
                                                <button class="p-2"><i class='bx bx-cart-add d-flex justify-content-center align-items-center'></i></button>
                                            </div>
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
                    <div class="text-center pageNumber d-flex justify-content-center">
                        <?php
                        $pageStart = floor($countProduct / 12);
                        if ($countProduct % 12 != 0) {
                            $pageStart++;
                        }
                        ?>
                        <?php
                        if ($pageStart > 1) { ?>
                            <form action="/project_2/product/index" method="POST">
                                <?php if ($_SESSION['pageStart'] == 0) { ?>
                                    <button class="px-1 me-2" disabled> <i class='bx bx-caret-left'></i> </button>
                                <?php } else { ?>
                                    <input type="text" name="pageStart" value="<?php echo $_SESSION['pageStart'] - 12 ?>" hidden>
                                    <button class="px-1 me-2"> <i class='bx bx-caret-left'></i> </button>
                                <?php } ?>
                            </form>
                            <div class="d-flex justify-content-center">
                                <?php for ($i = 1; $i <= $pageStart; $i++) { ?>
                                    <form action="/project_2/product/index" method="POST">
                                        <input type="text" name="pageStart" value="<?php echo ($i - 1) * 12 ?>" hidden>
                                        <button class="px-2 me-2" name="submit-page_start"><?php echo $i; ?></button>
                                    </form>
                                <?php } ?>
                            </div>

                            <form action="/project_2/product/index" method="POST">
                                <?php if ($_SESSION['pageStart'] + 12 > $countProduct) { ?>
                                    <button class="px-1" name="submit-page_start" disabled><i class='bx bx-caret-right'></i></button>
                                <?php } else { ?>
                                    <input type="text" name="pageStart" value="<?php echo $_SESSION['pageStart'] + 12 ?>" hidden>
                                    <button class="px-1" name="submit-page_start"><i class='bx bx-caret-right'></i></button>
                                <?php } ?>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".filter-form").submit(function(event) {
            var minPrice = parseInt($("input[name='minimum-price']").val());
            var maxPrice = parseInt($("input[name='maximum-price']").val());

            if (maxPrice < minPrice) {
                alert("Maximum price must be greater than or equal to the minimum price.");
                event.preventDefault(); // Prevent the form from submitting
            }
        });
    });
</script>