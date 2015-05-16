<div class="container">

    <form class="form-signin">
        <img src="<?php echo $domain.'/resources/img/logo.png'; ?>" />
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        <div class="row">
            <div class="col-sm-6 text-center">
                <a href="<?php echo $domain.'/login/'; ?>">Login</a>
            </div>
            <div class="col-sm-6 text-center">
                <a href="<?php echo $domain.'/register/'; ?>">Register</a>
            </div>
        </div>
    </form>

</div> <!-- /container -->