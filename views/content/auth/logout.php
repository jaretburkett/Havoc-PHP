<?php
// unset cookie
setcookie("username",'loggedout',time()+1 ,'/'); // set cookie for 1 second
setcookie("saltypass",'loggedout',time()+1 ,'/'); // set cookie for 1 second

// todo fix this page and make it pretty and use javascript timed redirect
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <img src="<?php echo $domain; ?>/resources/img/logo.png"/><br><br>
            <h3>Logged out</h3>
            <p class="lead">You will be redirected shortly.</p>
            <p> If you are not automatically redirected, <a href="<?php echo $domain ?>">click here.</a> </p>
        </div>
    </div>
</div>

<script>
    // redirect to home page in 4 seconds
    window.setTimeout(function() { window.location.href = '<?php echo $domain; ?>'; }, 3000);
</script>
