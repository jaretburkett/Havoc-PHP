<?php
// TODO add username field
?>

<div class="container">

    <form class="form-auth">
        <img src="<?php echo $domain . '/resources/img/logo.png'; ?>"/>

        <div class="well">
            <strong>Register</strong> for <?php echo $website_name; ?>
        </div>
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="password2" class="sr-only">Password Again</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                </div>
                <input type="password" id="password2" name="password2" class="form-control"
                       placeholder="Password Again">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="sr-only">First Name</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="sr-only">Last Name</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name">
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        <div class="row">
            <div class="col-xs-6 text-center">
                <a href="<?php echo $domain . '/login/'; ?>">
                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                    &nbsp; Login
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
        submitHandler: function (form) {
            $(form).ajaxSubmit();
        },
        rules: {
            username:{
                required: true,
                minlength: 3,
                maxlength: 20,
                remote: {
                    url: "<?php echo $domain.'/backend/auth/check_username_availability.php'; ?>",
                    type: "post",
                    data: {
                        login: function () {
                            return $('.form-auth :input[name="username"]').val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo $domain.'/backend/auth/check_email_availability.php'; ?>",
                    type: "post",
                    data: {
                        login: function () {
                            return $('.form-auth :input[name="email"]').val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            password2: {
                required: true,
                equalTo: "#password"
            },
            firstname: {
                //minlength: 2,
                maxlength: 50,
                required: true
            },
            lastname: {
                //minlength: 2,
                maxlength: 50,
                required: true
            }
        },
        messages: {
            username:{
                required: "Pick a username",
                remote: "This username is taken",
                minlength: $.validator.format("Username must be more than {0} characters"),
                maxlength: $.validator.format("Username cannot be more than {0} characters")
            },
            email: {
                required: "Enter your email",
                email: "Not a valid email address",
                remote: "This email is already registered"
            },
            password: {
                required: 'Enter a password',
                minlength: $.validator.format("Password must be more than {0} characters")
            },
            password2: {
                required: 'Enter password again',
                equalTo: 'Your passwords do not match'
            },
            firstname: {
                required: 'Enter your first name'
            },
            lastname: {
                required: 'Enter your last name'
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>