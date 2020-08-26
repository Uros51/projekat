<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "restoran";

$conn = new mysqli($servername, $username, $password, $db);
if(!$conn){
    die("Konekcija nije uspjela: " .mysqli_connect_error());
}
?>