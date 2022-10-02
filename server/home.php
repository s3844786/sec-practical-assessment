<?php
include('session.php');
if (!isset($_SESSION['login'])) {
    header('Location: ../client/home.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Secure Electronic Commerce</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../client/styles/main-page.css" />
</head>

<body>
    <div class="container">
        <div class="menu">
            <ul>
                <li>
                    <a href="home.php" class="logo"><img src="../resource/icons8-shop-64.png" /></a>
                </li>
                <li><a href="home.php" class="navbar-item">Home</a></li>
                <li><a href="catalog.php" class="navbar-item">Catalog</a></li>
                <li><a href="items.php" class="navbar-item">Items</a></li>
                <li><a href="?signout" class="login-btn">Sign out</a></li>
                <?php
                if (isset($_GET['signout'])) {
                    unset($_SESSION['username']);
                    unset($_SESSION['login']);
                    header("Location: ../client/home.html");
                }
                ?>
            </ul>
        </div>

        <div class="content">
            <?php
            $username = $_SESSION['username'];
            echo '<h1>Welcome, ' . $username . '</h1>';
            ?>
        </div>

        <div class="footer">
            <p>
                Practical assignment for Secure Electronic Commerce | s3844786 &
                s3845837
            </p>
        </div>
    </div>

    <script src="js/script.js" async defer></script>
</body>

</html>