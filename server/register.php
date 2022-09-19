<?php 

    $file_content = "../database/users.txt";
    $file = fopen($file_content,"r");
    $lines = count(file($file_content));

    $username_input = $_POST['username'];
    $password_input = $_POST['password'];
    $email_input = $_POST['email'];
    $phoneNumber_input = $_POST['phoneNumber'];
    $accountType_input = $_POST['accountType'];

    if(trim($username_input) != null && trim($password_input) != null && trim($email_input) != null && trim($phoneNumber_input) != null) {
        $isDuplicateName = false;
        while(!feof($file)){
            $line = fgets($file);
            
            list($username, $password) = explode(',', $line);
            if(trim($username) == $username_input){
                echo 'Username already taken';
                $isDuplicateName = true;
                break;
            }
        }
        if($isDuplicateName == false){
            $file = fopen("../database/users.txt","a"); 
            //insert $user_input into the database.txt 
            fwrite($file, $username_input.",".$password_input.",".$email_input.",".$phoneNumber_input.",".$accountType_input."\n");  
            //close the "$file" 
            fclose($file); 
            echo "Sucessfully registered user.";
        }
    }
?>