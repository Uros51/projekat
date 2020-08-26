<?php
require("connection.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

if($_SESSION['admin'] != 1){
    header("Location: index.php");
}

$sqlDrink = "select * from pice";
$resultDrink = $conn->query($sqlDrink);

$sqlFood = "select * from jelo";
$resultFood = $conn->query($sqlFood);



$myfile = fopen("menu.csv", "w") or die("Unable to open file!");

fwrite($myfile, "PICA:");
fwrite($myfile, "\nid,naziv,litara,cijena");

while($rowDrink = $resultDrink->fetch_assoc()){
    $txt = "\n" . $rowDrink["id"] . "," . $rowDrink["naziv"] . "," . $rowDrink["litara"] . "," . $rowDrink["cijena"];
    fwrite($myfile, $txt);
}
fwrite($myfile, "\nJELA:");
fwrite($myfile, "\nid,naziv,gramaza,cijena");



while($rowFood = $resultFood->fetch_assoc()){
    $txt = "\n" . $rowFood["id"] . "," . $rowFood["naziv"] . "," . $rowFood["gramaza"] . "," . $rowFood["cijena"];
    fwrite($myfile, $txt);
}


fclose($myfile);

$f="menu.csv";

$file = ("myfolder/$f");

$filetype=filetype($f);

$filename=basename($file);

header ("Content-Type: ".$filetype);

header ("Content-Length: ".filesize($f));

header ("Content-Disposition: attachment; filename= menu.csv".$filename);

readfile($f);


?>
