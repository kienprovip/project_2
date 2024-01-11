<header>
    <nav class="navbar navbar-expand-lg position-relative">
        <div class="container">
            <a class="navbar-brand position-absolute py-0 d-flex align-items-center" href="/project_2/home"><img src="http://localhost/project_2/public/assets/admin/images/shop_logo.jpg" alt=""></a>
            <ul class="d-flex d-lg-none justify-content-end ms-auto mb-0 me-4">
                <?php if (isset($_SESSION['customer'])) {
                ?>
                    <li class='nav-item pe-3 position-relative'>
                        <a href='/project_2/cart' class='nav-link'>
                            <i class='bx bx-cart-alt'></i>
                        </a>
                        <span class='position-absolute top-0 end-0 notification'><?php if (isset($_SESSION['cart_quantity'])) {
                                                                                        echo $_SESSION['cart_quantity'];
                                                                                    } ?></span>
                    </li>
                <?php
                } ?>
                <li class='nav-item ps-3'>
                    <span class='nav-link' onclick='toggleUser()'>
                        <i class='bx bx-user'></i>
                    </span>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-lg-auto pt-5 p-lg-0">
                    <li class="nav-item px-lg-2">
                        <a href="/project_2/home" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item px-lg-2">
                        <a href="/project_2/product" class="nav-link">PRODUCTS</a>
                    </li>
                    <li class="nav-item px-lg-2">
                        <a href="/project_2/aboutus" class="nav-link">ABOUT US</a>
                    </li>
                    <li class="nav-item px-lg-2">
                        <a href="/project_2/contact" class="nav-link">CONTACT</a>
                    </li>
                </ul>
            </div>
            <ul class=" d-none d-lg-flex justify-content-end navbar-nav ms-lg-auto">
                <?php if (isset($_SESSION['customer'])) {
                ?>
                    <li class='nav-item pe-lg-2'>
                        <a href='/project_2/cart' class='nav-link position-relative'>
                            <i class='bx bx-cart'></i>
                            <span class='position-absolute top-0 end-0 notification fw-bold'><?php if (isset($_SESSION['cart_quantity'])) {
                                                                                                    echo $_SESSION['cart_quantity'];
                                                                                                } ?></span>
                        </a>

                    </li>
                <?php
                } ?>
                <li class='nav-item ps-lg-2'>
                    <span onclick='toggleUser()' class='nav-link pe-lg-0'>
                        <i class='bx bx-user'></i>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="search">
        <div class="container d-flex justify-content-end">
            <form action="/project_2/product/index" method="POST" class=" d-flex justify-content-end py-3 me-3">
                <input type="text" name="search-product" class="me-3" placeholder="Product name" required>
                <button name="search-button" class="p-0"><i class="bx bx-search"></i></button>
            </form>
        </div>
    </div>
</header>