
<div class="container">

    <form class="form-auth">
        <img src="<?php echo $domain.'/resources/img/logo.png'; ?>" />
        <div class="well">
            <strong>Login</strong> to <?php echo $website_name; ?>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <div class="row">
            <div class="col-xs-6 text-center">
                <a href="<?php echo $domain.'/register/'; ?>">
                    <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
                    &nbsp; Register
                </a>
            </div>
            <div class="col-xs-6 text-center">
                <a href="<?php echo $domain . '/forgot_password/'; ?>">
                    <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    &nbsp; Forgot Password
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
            },
            password: {
                required:true,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            email: {
                required: "Enter your email",
                email: "Not a valid email address"
            },
            password:{
                required: 'Enter a password',
                minlength: $.validator.format("Password must be more than {0} characters")
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