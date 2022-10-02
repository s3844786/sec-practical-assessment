<?php
include('session.php');
require_once('../database/config.php');

$username_input = $_POST['username'];
$password_input = $_POST['password'];

$_SESSION['isAdmin'] = false;
$_SESSION['login'] = false;
$_SESSION['username'] = $username_input;

if (trim($username_input) != null && trim($password_input) != null) {
    try {
        $sql = "SELECT * FROM users WHERE (username=? OR email=?) AND password=? ";
        $query = $db->prepare($sql);
        $query->execute(array($username_input, $username_input, $password_input));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {
            // echo 'Succesfully logged in';
            $sql = "SElECT * FROM users WHERE username=? AND role=?";
            $query = $db->prepare($sql);
            $query->execute(array($username_input, 0));
            $row = $query->rowCount();
            $fetch = $query->fetch();
            if ($row > 0) {
                echo 'reg user';
                $_SESSION['isAdmin'] = false;
            } else {
                echo 'admin';
                $_SESSION['isAdmin'] = true;
            }
            $_SESSION['login'] = true;
            header("Location: home.php");
        } else {
            // echo 'Invalid username or password';
            $_SESSION['errorMessage'] = 'Invalid username or password';
            header("Location: login.php");
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage();
    }
} else {
    // echo 'Please enter username/email or password';
    $_SESSION['errorMessage'] = 'Please enter username/email or password';
    header("Location: login.php");
}
