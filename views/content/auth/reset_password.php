<?php

// include database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

$userID = $_GET['var2'];
$hash = $_GET['var3'];
$userhash = ''; // preset userhash

// check if they reset link is valid
$sql = "SELECT * FROM forgot_pass WHERE userID = '$userID'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        $userhash = $user['hash'];
    }
}

// begin content if link is valid
if ($hash == $userhash) {
    ?>

    <div class="container">

        <form class="form-auth">
            <img src="<?php echo $domain . '/resources/img/logo.png'; ?>"/>

            <div class="toReplace">
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Password">
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
                <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
                <input type="hidden" name="hash" value="<?php echo $userhash; ?>" />
                <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>

            </div>
        </form>
    </div> <!-- /container -->
    <script>
        $('.form-auth').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                password2: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: 'Enter a password',
                    minlength: $.validator.format("Password must be more than {0} characters")
                },
                password2: {
                    required: 'Enter password again',
                    equalTo: 'Your passwords do not match'
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
            $('.toReplace').removeClass('alert alert-danger alert-success');

            // dim until loaded
            $('.form-auth').fadeTo("fast", 0.20);
            var formdata = $('.form-auth').serializeArray();
            $.ajax(
                {
                    url: "<?php echo $domain.'/backend/auth/reset_password_script.php'; ?>",
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
                            // redirect to login page
                            setTimeout(function () {
                                window.location.href = '<?php echo $domain; ?>/login/';
                            }, 3000);
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
    <?php
    // end if link is valid
} else {
    // link is not valid
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <img src="<?php echo $domain; ?>/resources/img/logo.png"/><br><br>

                <h3>The link you are using is not valid.</h3>
            </div>
        </div>
    </div>
    <?php
} // end else of link not valid