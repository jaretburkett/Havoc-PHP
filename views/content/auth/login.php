<div class="container">

    <form class="form-auth">
        <img src="<?php echo $domain . '/resources/img/logo.png'; ?>"/>

        <div class="toReplace">
            <div id="notice" class="well">
                <strong>Login</strong> to <?php echo $website_name; ?>
            </div>
            <div class="form-group">
                <label for="username" class="sr-only">Username</label>

                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                           autofocus>
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <div class="row">
                <div class="col-xs-6 text-center">
                    <a href="<?php echo $domain . '/register/'; ?>">
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
        </div>
    </form>

</div> <!-- /container -->
<script>
    $('.form-auth').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            email: {
                required: "Enter your username"
            },
            password: {
                required: 'Enter a password',
                minlength: $.validator.format("Password must be more than {0} characters")
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        submitHandler: function () {
            submitForm()
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

    function submitForm() {
        // turn on loading
        loading('on');
        var formdata = $('.form-auth').serializeArray();
        $.ajax(
            {
                url: "<?php echo $domain.'/backend/auth/login_script.php'; ?>",
                type: "POST",
                //contentType: "application/json",
                data: formdata,
                success: function (data) {
                    // debug
                    console.log(data);
                    // parse json data
                    var response = JSON.parse(data);
                    // change well color based on response
                    if (response['code'] == 0) {
                        // failed, show in well
                        $('#notice').removeClass('well')
                            .addClass('alert alert-danger')
                            .html(response['message']);
                    } else if (response['code'] == 1) {
                        // success, show in well
                        $('.toReplace').addClass('alert alert-success')
                            .html(response['message']);
                        //redirect to homepage in 3 seconds
                        setTimeout(function () {
                            window.location.href = '<?php echo $domain; ?>';
                        }, 3000);
                    }
                    // turn off loading
                    loading('off');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                }
            });
    }
</script>