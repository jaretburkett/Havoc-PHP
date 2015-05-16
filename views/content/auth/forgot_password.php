<div class="container">

    <form class="form-auth">
        <img src="<?php echo $domain . '/resources/img/logo.png'; ?>"/>

        <div class="well">
            <strong>Forgot Password</strong> to <?php echo $website_name; ?>?<br>
            Enter your email and we will email you with a recovery link.
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        <div class="row">
            <div class="col-xs-6 text-center">
                <a href="<?php echo $domain . '/login/'; ?>">
                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                    &nbsp; Login
                </a>
            </div>
            <div class="col-xs-6 text-center">
                <a href="<?php echo $domain . '/register/'; ?>">
                    <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
                    &nbsp; Register
                </a>
            </div>
        </div>
    </form>

</div> <!-- /container -->
<script>
    $('.form-auth').validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit();
        },
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Enter your email",
                email: "Not a valid email address"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>