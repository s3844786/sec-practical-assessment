<?php
include('session.php');
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
                    <a href="home.html" class="logo"><img src="../resource/icons8-shop-64.png" /></a>
                </li>
                <li><a href="home.html" class="navbar-item">Home</a></li>
                <li><a href="catalog.html" class="navbar-item">Catalog</a></li>
                <li><a href="login.html" class="login-btn">Login</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="form-group">
                <h1>Create new account</h1>
                <form action="../server/registerVerification.php" method="POST">
                    <div>
                        <input type="text" class="form-input" name="username" id="username" placeholder="Username" required />
                    </div>
                    <input type="password" class="form-input" name="password" id="password" placeholder="Password" required />
                    <input type="email" class="form-input" name="email" id="email" placeholder="Email" required />
                    <input type="text" class="form-input" name="phoneNumber" id="phoneNumber" placeholder="Phone number" required />
                    <select class="form-input" name="accountType">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                    <button type="submit" onclick="hashPassword()">
                        Register account
                    </button>
                    <div class="signup-link">
                        <p>Have an account? Click <a href="login.html">here</a>!</p>
                    </div>
                </form>
                <?php
                $error = $_SESSION['errorMessage'];
                if ($error != '' && isset($error)) {
                    echo '<p class=error-message>' . $error . '</p>';
                    unset($_SESSION['errorMessage']);
                }
                ?>
            </div>
        </div>

        <div class="footer">
            <p>
                Practical assignment for Secure Electronic Commerce | s3844786 &
                s3845837
            </p>
        </div>
    </div>

    <script src="js/sha256.js"></script>
    <script type="text/javascript" src="js/script.js" async defer></script>
</body>

</html>