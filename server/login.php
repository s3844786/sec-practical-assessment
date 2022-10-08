<?php
include('session.php');
include('rsa.php')
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
                    <a href="../client/home.html" class="logo"><img src="../resource/icons8-shop-64.png" /></a>
                </li>
                <li><a href="../client/home.html" class="navbar-item">Home</a></li>
                <li><a href="../client/catalog.html" class="navbar-item">Catalog</a></li>
                <li><a href="../client/login.html" class="login-btn">Login</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="form-group">
                <h1>Login</h1>
                <form action="loginVerification.php" method="POST">
                    <div>
                        <input type="text" class="form-input" name="username" id="username" placeholder="Username or Email address" required />
                    </div>
                    <input type="password" class="form-input" name="password" id="password" placeholder="Password" required />
                    <button type="submit" onclick="hashPassword()">Login</button>
                    <div class="signup-link">
                        <p>
                            Don't have an account? Click <a href="register.html">here</a>!
                        </p>
                    </div>
                </form>
                <?php
                $error = $_SESSION['errorMessage'];
                if ($error != '' && isset($error)) {
                    echo '<p class=error-message>' . $error . '</p>';
                    unset($_SESSION['errorMessage']);
                }
                ?>
                
                <?php
                if(isset($_POST['username']) == FALSE){
                    header('Location: ../client/login.html');
                }
                
                $entered_username = $_POST['username'];
                
                $ciphertextReceived = $_POST['password'];
                
                $privateKey = get_rsa_privatekey('private.key');
                
                $decrypted = rsa_decryption($ciphertextReceived, $privateKey);
                
                $myArr = explode("&", $decrypted);
                
                $hashOfUserPassword = $myArr[0];
                $userTimestamp = $myArr[1];
                $serverTimeStamp = time();
                
                if(abs($serverTimeStamp - $userTimestamp) >= 150) {
                    echo("<p>Your session has expired</p>");
                    exit();
                }
                
                $entered_password = $hashOfUserPassword;
    
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
    <script type="text/javascript" src="../client/js/script.js" async defer></script>
</body>

</html>
       
