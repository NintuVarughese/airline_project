<?php 
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "db_air";
$conn = new mysqli($server_name, $username, $password, $db_name);
if($conn->connect_error == TRUE){
    echo "Failed".$conn->connect_error;
}
?>