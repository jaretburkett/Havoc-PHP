<?php
// include framework variables
include($_SERVER['DOCUMENT_ROOT'] . '/config/vars.php');
include($_SERVER['DOCUMENT_ROOT'] . '/config/mail.php');

// get hash from GET
//if (isset($_GET['hash'])) $hash = $_GET['hash'];
//else $hash = '';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $website_name; ?></title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
    <div style="width: 100%; text-align: center;">
        <?php
        // this src loads the attached image. The attached image is at /resources/img/logo.png
        ?>
        <img src="cid:logo_2u.png" alt=""/>
    </div>
    <h2><?php echo $website_name; ?></h2>

    <p>
        <a href="<?php echo $domain; ?>/reset_password/<?php echo $userID.'/'.$hash.'/'; ?>/">
            CLICK HERE
        </a>
        to reset your password
    </p>
    <p>Or, copy and paste this link into your browser.</p>
    <p><?php echo $domain; ?>/reset_password/<?php echo $userID.'/'.$hash.'/'; ?></p>

    <p><strong><?php echo $website_name; ?></strong>.</p>

</div>
</body>
</html>
