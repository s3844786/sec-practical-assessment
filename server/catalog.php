<?php
include('session.php');
if (!isset($_SESSION['login'])) {
    header('Location: ../client/home.html');
}

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "id");

        if (!in_array($_GET['id'], $session_array_id)) {
            $session_array = array(
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );

            $_SESSION['cart'][] = $session_array;
        }
    } else {
        $session_array = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );

        $_SESSION['cart'][] = $session_array;
    }
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
            <h1>Catalog</h1>
            <div class="item-container">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "test");
                $sql = "SELECT * FROM products ORDER BY id ASC";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo '
                    <form method="POST" action=catalog.php?id=' . $row['id'] . '>
                    <div class="card">
                    <h1>' . $row['name'] . '</h1>
                    <img src=' . $row['image'] . '>
                    <p class="price">' . $row['price'] . '</p>
                    <input type="hidden" name="name" value=' . $row['name'] . '>
                    <input type="hidden" name="price" value=' . $row['price'] . '>
                    <input type="number" name="quantity" value=1 min="1">
                    <button type="submit" name="add_to_cart" value="Add to cart">Add to cart</button>
                    </div>
                    </form>
                    ';
                }
                ?>
            </div>



            <h1>Cart</h1>
            <?php
            $total = 0;

            $output = "";

            $output .= '
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Item Name</th>
                                <th width="10%">Quantity</th>
                                <th width="20%">Price</th>
                                <th width="15%">Total</th>
                                <th width="5%">Action</th>
                            </tr>
                        ';

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $output .= '
                    <tr>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['price'] . '</td>
                        <td>' . $value['quantity'] . '</td>
                        <td>' . number_format($value['price'] * $value['quantity'], 2) . '</td>
                        <td>
                            <a href="catalog.php?action=remove&id=' . $value['id'] . '"><button>Remove</button></a>
                        </td>
                    </tr>
                    ';
                    $total = $total + ($value['quantity'] * $value['price']);
                }
            }

            $output .= '
                <tr>
                <td></td>
                <td></td>
                <td>Total Price</td>
                <td>' . number_format($total, 2) . '</td>
                <td>
                    <a href="catalog.php?action=clearall">
                        <button>Clear</button>
                    </a>
                </td>
                </tr>
            ';

            $output .= '</table>';

            echo $output;
            ?>

            <?php

            if (isset($_GET['action'])) {
                if ($_GET['action'] == "clearall") {
                    unset($_SESSION['cart']);
                }

                if ($_GET['action'] == "remove") {
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if ($value['id'] == $_GET['id']) {
                            unset($_SESSION['cart'][$key]);
                        }
                    }
                }
            }


            ?>
            
                    
            <br><br>
            
            <script src="../client/js/index.js" async defer></script>
            <script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>

            <button type="button" aria-label="Google Pay" class="gpay-card-info-container black long en">
                <div class="gpay-card-info-animation-container black gpay-card-info-animation-container-fade-out">
                    <div class="gpay-card-info-placeholder-container">
                        <div class="gpay-card-info-animation-gpay-logo black"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" direction="ltr" height="36px" width="130px"></svg>
                        </div><div class="gpay-card-info-animated-progress-bar-container">
                        <div class="gpay-card-info-animated-progress-bar"><div class="gpay-card-info-animated-progress-bar-indicator"></div></div></div>
                </div>
                <iframe class="gpay-card-info-iframe gpay-card-info-iframe-fade-in" scrolling="no" src="https://pay.google.com/gp/p/generate_gpay_btn_img?buttonColor=black&amp;browserLocale=en&amp;buttonSizeMode=static&amp;enableGpayNewButtonAsset=false"></iframe>
            </button>

            <div class="footer">
                <p>
                    Practical assignment for Secure Electronic Commerce | s3844786 &
                    s3845837
                </p>
            </div>
        </div>

        <script src="../client/js/script.js" async defer></script>
        <script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
</body>

</html>
