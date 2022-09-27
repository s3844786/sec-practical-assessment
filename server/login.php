<?php
require_once('../database/config.php');

$username_input = $_POST['username'];
$password_input = $_POST['password'];

if (trim($username_input) != null && trim($password_input) != null) {
    try {
        $sql = "SELECT * FROM users WHERE username=? AND password=? ";
        $query = $db->prepare($sql);
        $query->execute(array($username_input, $password_input));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {
            echo 'Success';
        } else {
            echo 'Invalid username or password';
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage();
    }
} else {
    echo 'invalid input';
}
