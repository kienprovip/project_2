<div class="container">
    <div class="row">
        <div class="col-lg-2">&nbsp</div>
        <div class="col-lg-8 text-center">
            <div class="login">
                <h2 class="login-title py-3">LOGIN</h2>
                <form action="loginCheck" method="POST">
                    <div class="d-flex justify-content-center align-items-center mt-5 mb-3">
                        <label for="login-input_email" class="label-input_email d-flex justify-content-center align-items-center"><i class='bx bxs-user'></i></label>
                        <input type="email" id="login-input_email" name="email" class="input-input_email px-2" placeholder="Email" required>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="login-input_password" class="label-input_password d-flex justify-content-center align-items-center"><i class='bx bxs-lock-alt'></i></label>
                        <input type="password" id="login-input_password" name="password" class="input-input_password px-2" placeholder="Password" required>
                    </div>
                    <div><?php if (isset($_SESSION['error_login'])) {
                                echo $_SESSION['error_login'];
                            } ?></div>
                    <p><?php echo (!empty($login_failed)) ? $login_failed : ''; ?></p>
                    <a href="#" class="forgot-password">Forgot password?</a>
                    <br>
                    <div class="my-3">
                        <input type="submit" value="Login" class="login-input_submit">
                    </div>
                    <div class="pb-5">
                        <span>Not a member? <a href="/project_2/my_account/register" class="signup-now">Signup now</a></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2">&nbsp</div>
    </div>
</div>