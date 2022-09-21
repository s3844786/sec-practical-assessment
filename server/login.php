<?php
    print_r($_POST);

    $file_content = "../database/users.txt";
    $file = fopen($file_content,"r");
    $lines = count(file($file_content));

    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    if(trim($username_input) != null && trim($password_input) != null) {
        while(!feof($file)){
            $line = fgets($file);
            
            // Issue here is that only looks at first line of user file and breaks
            list($username, $password, $email, $phoneNumber) = explode(',', $line);
            if((trim($username) == $username_input || trim($email) == $username_input) && trim($password) == $password_input){
                echo 'Logged in';
                break;
            } else {
                echo 'Invalid username or password';
                break;
            }
        }
        fclose($file);
    }

?>