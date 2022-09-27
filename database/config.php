<?php

$db_user = "root";
$db_pass = "";
$db_name = "test";

$db = new PDO('mysql:host=localhost;dbname=' . $db_name . '; charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$db) {
    die('Error: Failed to connect to database!');
}
