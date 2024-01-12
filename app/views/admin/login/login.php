<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="http://localhost/project_2/public/assets/admin/css/responsive.css" />
    <link rel="stylesheet" href="http://localhost/project_2/public/assets/admin/css/style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">&nbsp</div>
            <div class="col-lg-8 text-center">
                <div class="login">
                    <h2 class="login-title py-3">LOGIN</h2>
                    <form action="/project_2/admin/loginCheck" method="POST">
                        <div class="d-flex justify-content-center align-items-center mt-5 mb-3">
                            <label for="login-input_email" class="label-input_email d-flex justify-content-center align-items-center"><i class='bx bxs-user'></i></label>
                            <input type="email" id="login-input_email" name="email" class="input-input_email px-2" placeholder="Email">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <label for="login-input_password" class="label-input_password d-flex justify-content-center align-items-center"><i class='bx bxs-lock-alt'></i></label>
                            <input type="password" id="login-input_password" name="password" class="input-input_password px-2" placeholder="Password">
                        </div>
                        <div>
                            <?php if (isset($_SESSION['error_login_admin']) && !empty($_SESSION['error_login_admin'])) {
                                echo $_SESSION['error_login_admin'];
                            } ?>
                        </div>
                        <div class="my-3">
                            <input type="submit" value="Login" class="login-input_submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2">&nbsp</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/project_2/public/assets/admin/js/script.js"></script>
</body>

</html>