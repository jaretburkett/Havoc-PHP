<div class="container">

    <form class="form-auth">
        <img src="<?php echo $domain . '/resources/img/logo.png'; ?>"/>

        <div class="toReplace">
            <div id="notice" class="well">
                <strong>Forgot Password</strong> to <?php echo $website_name; ?>?<br>
                Enter your username and we will email you with a recovery link.
            </div>
            <div class="form-group">
                <label for="username" class="sr-only">Username</label>

                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                           required autofocus>
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
        </div>
    </form>

</div> <!-- /container -->
<script>
    $('.form-auth').validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 20,
            }
        },
        messages: {
            username: {
                required: "Enter your username",
                minlength: $.validator.format("Username must be more than {0} characters"),
                maxlength: $.validator.format("Username cannot be more than {0} characters")
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
        // TODO make a loading display. takes a while. fade for now
        // remove classes of well

        // dim until loaded
        $('.form-auth').fadeTo("fast", 0.20);
        var formdata = $('.form-auth').serializeArray();
        $.ajax(
            {
                url: "<?php echo $domain.'/backend/auth/forgot_password_script.php'; ?>",
                type: "POST",
                //contentType: "application/json",
                data: formdata,
                success: function (data) {
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
                    }
                    // undim after done
                    $('.form-auth').fadeTo("fast", 1);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                }
            });
    }
</script>