<div class="container user-show" id="user-show-scroll">
    <div class="row">
        <div class="col-3 col-md-6 col-lg-8"></div>
        <div class="col-9 col-md-6 col-lg-4">
            <div class="user">
                <div class="user-profile">
                    <div class="user-avatar p-3">
                        <img src="https://pages.10xgenomics.com/rs/446-PBO-704/images/unknown%20user.png" alt="">
                    </div>
                    <div class="user-information p-3">
                        <p><?php
                            if (isset($_SESSION['customer'])) {
                                echo $_SESSION['customer'][1];
                            } else {
                                echo 'No Name';
                            } ?>
                        </p>

                        <p><?php
                            if (isset($_SESSION['customer'])) {
                                echo $_SESSION['customer'][2];
                            } else {
                                echo 'No Name';
                            } ?>
                        </p>

                        <p><?php
                            if (isset($_SESSION['customer'])) {
                                echo $_SESSION['customer'][3];
                            } else {
                                echo 'No Name';
                            } ?>
                        </p>


                    </div>
                </div>

                <?php if (isset($_SESSION['customer'])) {
                    echo '<div class="user-function p-3">
                    <ul class="user-function_list ps-0">
                        <li class="user-function_item my-3"><a href="/project_2/orders" class="nav-link">Orders</a></li>
                    </ul>
                </div>';
                } ?>

                <div class="log py-5 d-flex justify-content-center">
                    <form action="/project_2/my_account/logout" method="POST">
                        <?php if (isset($_SESSION['customer'])) {
                            echo '<button class="px-3 py-1">Log out</button>';
                        } else {
                            echo '<a href="/project_2/my_account/login" class="px-3 py-1">Log in</a>';
                        } ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>