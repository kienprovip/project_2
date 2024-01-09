<div class="container">
    <div class="row">
        <div class="col-lg-2 d-none d-lg-block">&nbsp</div>
        <div class="col-lg-8 text-center">
            <div class="register">
                <h2 class="register-title py-3">SIGNUP</h2>
                <form action="registerAdd" method="POST" onsubmit="return validateForm()">

                    <div class="d-flex justify-content-center align-items-center mt-5 mb-3">
                        <input type="text" name="firstname" class="input-input_firstname px-2" placeholder="First name">
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <input type="text" name="lastname" class="input-input_lastname px-2" placeholder="Last name">
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <span class="position-relative">
                            <input type="text" name="phonenumber" class="input-input_phonenumber px-2" placeholder="Phone number" oninput="validatePhoneNumber()" required>
                            <div class="check-true_phonenumber position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-check'></i>
                            </div>
                            <div class="check-false_phonenumber position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-x'></i>
                            </div>
                        </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <span class="position-relative">
                            <input type="email" name="email" class="input-input_email px-2" placeholder="Email" oninput="validateEmail()" required>
                            <div class="check-true_email position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-check'></i>
                            </div>
                            <div class="check-false_email position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-x'></i>
                            </div>
                        </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <span class="position-relative">
                            <input type="password" class="input-input_password px-2" placeholder="Password" oninput="validatePassword()" required>
                            <div class="check-true_password position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-check'></i>
                            </div>
                            <div class="check-false_password position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-x'></i>
                            </div>
                        </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <span class="position-relative">
                            <input type="password" name="password" class="input-input_confirmpassword px-2" oninput="validateConfirmPassword()" required placeholder="Confirm password">
                            <div class="check-true_confirmpassword position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-check'></i>
                            </div>
                            <div class="check-false_confirmpassword position-absolute end-0 top-0 bottom-0 align-items-center justify-content-center pe-2">
                                <i class='bx bx-x'></i>
                            </div>
                        </span>
                    </div>
                    <div class="my-3">
                        <input type="submit" value="Signup" name="register" class="register-input_submit">
                    </div>
                    <div class="pb-5">
                        <span>Already have an account? <a href="/project_2/my_account/login" class="login-now">Login now</a></span>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-2 d-none d-block">&nbsp</div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function validateEmail() {
        var enteredEmail = document.querySelector('.input-input_email').value;
        var accountList = <?php echo json_encode($data['account_list']); ?>;
        var checkTrue = document.querySelector('.check-true_email');
        var checkFalse = document.querySelector('.check-false_email');
        var pattern = /^.+@.+$/;
        if (accountList.length < 1 && pattern.test(enteredEmail)) {
            checkTrue.style.display = 'flex';
            checkFalse.style.display = 'none';
            return;
        } else if (accountList.length < 1 && !pattern.test(enteredEmail)) {
            checkTrue.style.display = 'none';
            checkFalse.style.display = 'flex';
            return;
        } else {
            for (var i = 0; i < accountList.length; i++) {
                var customerEmail = accountList[i]['customer_email'];

                if (enteredEmail === customerEmail || enteredEmail === '' || !pattern.test(enteredEmail)) {
                    checkTrue.style.display = 'none';
                    checkFalse.style.display = 'flex';
                    return;
                }

                checkTrue.style.display = 'flex';
                checkFalse.style.display = 'none';
                updateSubmitButton();
            }
        }

    }

    function validatePassword() {
        var enteredPassword = document.querySelector('.input-input_password').value;
        var checkTrue = document.querySelector('.check-true_password');
        var checkFalse = document.querySelector('.check-false_password');
        if (enteredPassword.length <= 7) {
            checkTrue.style.display = 'none';
            checkFalse.style.display = 'flex';
            return;
        }
        checkTrue.style.display = 'flex';
        checkFalse.style.display = 'none';
        updateSubmitButton();
    }

    function validateConfirmPassword() {
        var enteredConfirmPassword = document.querySelector('.input-input_confirmpassword').value;
        var checkTrue = document.querySelector('.check-true_confirmpassword');
        var checkFalse = document.querySelector('.check-false_confirmpassword');
        var enteredPassword = document.querySelector('.input-input_password').value;
        if (enteredConfirmPassword !== enteredPassword || enteredConfirmPassword === '') {
            checkTrue.style.display = 'none';
            checkFalse.style.display = 'flex';
            return;
        }
        checkTrue.style.display = 'flex';
        checkFalse.style.display = 'none';
        updateSubmitButton();
    }

    function validatePhoneNumber() {
        var enteredPhoneNumber = document.querySelector('.input-input_phonenumber').value;
        var checkTrue = document.querySelector('.check-true_phonenumber');
        var checkFalse = document.querySelector('.check-false_phonenumber');
        var pattern = /^[0-9]+$/;
        if (enteredPhoneNumber.length != 10 || !pattern.test(enteredPhoneNumber)) {
            checkTrue.style.display = 'none';
            checkFalse.style.display = 'flex';
            return;
        }
        checkTrue.style.display = 'flex';
        checkFalse.style.display = 'none';
        updateSubmitButton();
    }

    function updateSubmitButton() {
        var checkTruePhoneNumber = document.querySelector('.check-true_phonenumber');
        var checkTrueConfirmPasswrord = document.querySelector('.check-true_confirmpassword');
        var checkTruePassword = document.querySelector('.check-true_password');
        var checkTrueEmail = document.querySelector('.check-true_email');
        var registerSubmit = document.querySelector('.register-input_submit');
        if (checkTruePhoneNumber.style.display === 'flex' && checkTrueConfirmPasswrord.style.display === 'flex' && checkTruePassword.style.display === 'flex' && checkTrueEmail.style.display === 'flex') {
            registerSubmit.disabled = false;
        } else {
            registerSubmit.disabled = true;
        }


    }
</script>