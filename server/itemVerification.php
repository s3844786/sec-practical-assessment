<?php

include('session.php');
require_once('../database/config.php');

$item_name = $_POST['name'];
$item_price = $_POST['price'];
// $item_image = $_POST['image'];
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];

$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
$img_ex_lc = strtolower($img_ex);
$item_image = uniqid("IMG-", true) . '.' . $img_ex_lc;
$img_upload_path = 'uploads/' . $new_img_name;
move_uploaded_file($tmp_name, $img_upload_path);


if (trim($item_name) != null && trim($item_price) != null && trim($item_image) != null) {
    if ($_SESSION['isAdmin'] == true) {
        echo 'is admin';
        try {
            $sql = "INSERT INTO products (name, price, image) VALUES(?,?,?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$item_name, $item_price, $item_image]);
            if ($result) {
                echo 'Success';
            } else {
                echo 'There was an error';
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage();
        }
    } else {
        $_SESSION['errorMessage'] = 'You do not have permission to add item to database.';
        echo $_SESSION['errorMessage'];
        header("Location: items.php");
    }
    // 
} else {
    $_SESSION['errorMessage'] = 'Please fill out the boxes or select an image.';
    echo $_SESSION['errorMessage'];
    header("Location: items.php");
}
