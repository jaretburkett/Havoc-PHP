<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $pathtopartials.'head.php' ?>
</head>

<body>

<div class="page">
    <header>
        <?php include $pathtopartials.'header.php'; ?>
    </header>
    <div style="height: 50px;"></div>
    <?php include $content; ?>
    <!-- The menu -->
    <nav id="menu">
        <?php include $pathtopartials.'nav.php'; ?>
    </nav>


    <?php include $pathtopartials.'scripts.php';?>


</body>
</html>
