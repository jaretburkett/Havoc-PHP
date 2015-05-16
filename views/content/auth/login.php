<div class="container">

    <form class="form-signin">
        <img src="<?php echo $domain.'/resources/img/logo.png'; ?>" />
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <div class="row">
            <div class="col-sm-6 text-center">
                <a href="<?php echo $domain.'/register/'; ?>">Register</a>
            </div>
            <div class="col-sm-6 text-center">
                <a href="<?php echo $domain.'/forgot_password/'; ?>">Forgot Password</a>
            </div>
        </div>
    </form>

</div> <!-- /container -->