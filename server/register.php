<?php
require_once('../database/config.php');

$username_input = $_POST['username'];
$password_input = $_POST['password'];
$email_input = $_POST['email'];
$phone_input = $_POST['phoneNumber'];
$account_input = $_POST['accountType'];

if (trim($username_input) != null && trim($password_input) != null && trim($email_input) != null && trim($phone_input) != null) {
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username_input));

        $result = $stmt->fetchAll();

        if (count($result) > 0) {
            echo 'Username already exists';
        } else {
            try {
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $db->prepare($sql);
                $stmt->execute(array(':email' => $email_input));

                $result = $stmt->fetchAll();

                if (count($result) > 0) {
                    echo 'Email already exists';
                } else {
                    try {
                        $sql = "INSERT INTO users (username, password, email, phone, role) VALUES(?,?,?,?,?)";
                        $stmtinsert = $db->prepare($sql);
                        $result = $stmtinsert->execute([$username_input, $password_input, $email_input, $phone_input, $account_input]);
                        if ($result) {
                            echo 'Success';
                        } else {
                            echo 'There was an error';
                        }
                    } catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage();
                    }
                }
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage();
            }
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage();
    }
} else {
    echo 'Cannot be empty';
}
