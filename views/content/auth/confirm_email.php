<?php
// get hash from url
$hash = $_GET['var2'];

// set the success variable
$success = false;
// pull user data and check salty pass
$mysql = "SELECT * FROM tmp_users WHERE hash ='$hash'";
$result = mysqli_query($con, $mysql);
if ($result->num_rows > 0) {
    // move from tmp_users to users
    while ($row = $result->fetch_assoc()) {
        // create mysql script, it is done this way to future proof the move script
        // dont judge me
        $i = 1;
        $len = count($row);
        $sql = "INSERT INTO users (";
        foreach ($row as $key => $value) {
            if($key != 'hash' && $key != 'id'){ // dont move the hash or id
                $sql .= $key;
                if ($i != $len) // add comma if not last
                    $sql .= ", ";
            }
            $i++;
        }
        $sql .= ") VALUES (";
        $i = 1;
        $len = count($row);
        foreach ($row as $key => $value) {
            if($key != 'hash' && $key != 'id') { // dont move the hash or id
                $sql .= "'$value'";
                if ($i != $len) // add comma if not last
                    $sql .= ", ";
            }
            $i++;
        }
        $sql .= ')';
        // mysql script now in $sql
    }
    if ($con->query($sql) === TRUE) {
        // table moved successfully. Now delete the old one
        $sql = "DELETE FROM tmp_users where hash = '$hash'";
        if ($con->query($sql) === TRUE) {
            // table removed
            $message = 'Your email has been verified. You will be redirected shortly';
            $success = true;
        } else {
            $message = "Error : " . $con->error;
        }
    } else {
        $message = "Error : " . $con->error;
    }

} else {
    $message = 'The link you used is either old or no longer valid';
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <img src="<?php echo $domain; ?>/resources/img/logo.png"/><br><br>
            <h3><?php echo $message ?></h3>
        </div>
    </div>
</div>

<script>
    <?php
// only redirect to main page after 5 seconds
if($success){
    echo "window.setTimeout(function() { window.location.href = '$domain'; }, 5000);";
}
?>
</script>

