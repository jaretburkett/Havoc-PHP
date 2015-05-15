<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Install HavocPHP</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon"
          type="image/png"
          href="favicon.png">

    <!-- Custom styles for this template -->
    <style>

        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<div class="container">

    <div class="starter-template">
        <h1><img src="logo-name.png">
            <small>v0.1</small>
        </h1>
        <hr>
        <br>


        <h1>Install</h1>

        <div class="row">

            <div class="col-sm-6">
                <p class="lead">What it does</p>

                <p>This script will install the required tables in your MySQL database to run Havoc's login scripts.
                    The minimum table configuration will be installed for the Havoc Auth system.</p>
            </div>
            <div class="col-sm-6">
                <p class="lead">This will allow Havoc to.</p>
                <ul>
                    <li>Register new users</li>
                    <li>Login and track users</li>
                </ul>
            </div>
        </div>


        <br>

        <p class="lead">First complete this checklist. </p>
        <br>

        <div class="well">
            <ol>
                <li>Setup an empty MySQL Database.</li>
                <li>Put your database credentials in /config/connect.php</li>
                <li>Done! Click the button below.</li>
            </ol>
        </div>
        <br>
        <button class="btn btn-primary btn-lg" onclick="install();">Install HavocPHP</button>

    </div>

</div>
<!-- /.container -->

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="havocmodal" tabindex="-1" role="dialog" aria-labelledby="havocmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body" id="havocmodalcontent">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function install(){
        $.get("script/create-tables.php", function(data){
            $('#havocmodalcontent').html(data);
            $('#havocmodal').modal('toggle');
        });
    }
</script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
