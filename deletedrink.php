<?php
session_start();
require("connection.php");

if(!isset($_SESSION['admin']) || $_SESSION['admin'] == 0){
    echo -1;
}

if(!isset($_GET['id'])){
    echo -1;
}

$id = $_GET['id'];

if($conn->query("delete from pice where id = $id")){
    echo $id;
}else{
    echo -1;
}
?>