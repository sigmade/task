<!DOCTYPE html>
<html lang="ru">
<head>
    <? require_once "App/views/blocks/metaHeaders.php" ?>
    <title><? echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/resources/css/login.scss">
</head>
<body>
<div id="logreg-forms"> <!-- форма авторизации -->
    <form action="" method="post" enctype="multipart/form-data" class="form-signin">
        <input type="hidden" name="method_name" value="enter">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Войти</h1>
        <div class="social-login">
            <span class="text-center">
            <div id="uLogin_8542e3e5" data-uloginid="8542e3e5"></div>
            </span>
        </div>
        <p style="text-align:center"> Или  </p>
        <input type="email" name="email" value="<? echo $inputs_val["email"]; ?>" id="inputEmail" class="form-control" placeholder="Email адрес" required="" autofocus="">
        <input type="password" name="pass" value="<? echo $inputs_val["pass"]; ?>" id="inputPassword" class="form-control" placeholder="Пароль" required="">
        <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Войти</button>
        <? if($error){ echo "<div class='alert alert-danger mt-3' role='alert'><b>Ошибка! </b>{$error['error_text']}</div>";} ?>

        <? if($succes){ echo "<div class='alert alert-success mt-3' role='alert'>{$succes['succes_text']}</div>";} ?>

        <a href="#" id="forgot_pswd">Забыли пароль?</a>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <!--   <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button> -->
    </form>

    <form action="/reset/password/" class="form-reset">
        <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
        <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
    </form>

    <form action="/signup/" class="form-signup">
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
        </div>
        <div class="social-login">
            <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
        </div>

        <p style="text-align:center">OR</p>

        <input type="text" id="user-name" class="form-control" placeholder="Full name" required="" autofocus="">
        <input type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
        <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="">

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
        <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

</div>
<p style="text-align:center">
    <a href="http://bit.ly/2RjWFMfunction toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})g" target="_blank" style="color:black"></a>
</p>
<? require_once "App/views/blocks/scripts.php"?>
<script src="/resources/js/login.js"></script>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin_8542e3e5" data-uloginid="8542e3e5"></div>
</body>
</html>
