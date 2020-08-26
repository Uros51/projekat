<?php
error_reporting(0);
include 'connection.php';
if(isset($_POST['register'])) {
if($_POST['password'] == $_POST['repass']){
    $result = "";
    $username = $_POST['username'];
    $ime = $_POST['name'];
    $password =  $_POST['password'];
    $sql= "INSERT INTO korisnik(username, password , ime)VALUES('$username','$password','$ime')";
    if(mysqli_query($conn , $sql)){
        $result = "Uspjesno ste se registrovali ,  mozete da se ulogujete!";
    }
    else{
        $result = "Registracija nije uspjela";
    }
}
else{
    $result = "Pasword se ne poklapa!";
}
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Kafe Bar</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"><script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link href="css/login.css" rel="stylesheet"></script>
</head>
<body >

<script>


function myFunction() {
    var temp = document.getElementById("myInput");
    if (temp.type === "password") {
        temp.type = "text";
    }
    else {
        temp.type = "password";
    }
}

</script>
<script>


function myFunction1() {
var temp = document.getElementById("mojaFunkcija");
if (temp.type === "password") {
temp.type = "text";
}
else {
temp.type = "password";
}
}
</script>
<div id="fullscreen_bg" class="fullscreen_bg"/>

    <div class="container">


    <form class="form-signin" action="register.php" method="POST">
        <h1 class="form-signin-heading">Restoran Harmonija</h1>

        <input type="text" id="username" class="form-control" placeholder="Unesite username" name="username" required>
    <input style="border-top-style:none;border-top:1px solid rgba(0,0,0,0.08);" type="text" class="form-control" placeholder="Unesite ime i prezime" name="name" required>
    <input type="password"   id="myInput"name="password" placeholder="Unesite lozinku" required>
    <b style=" color: #eeeeee"><input type="checkbox" onclick="myFunction()" > PRIKAZI</b>
    <input type="password"   id="mojaFunkcija" name="repass" placeholder="potvrdite  lozinku" required>
        <b style=" color: #eeeeee"><input type="checkbox" onclick="myFunction1()" > PRIKAZI</b>
   <input type = "submit" class="form-control" name = "register" value = "REGISTRUJTE SE" id = "sub-btn"   >

    <a href="login.php"  style="color:white;">Login stranica</a>
    </form>

    </div>
    <div style= "fontsize:30px; text-align:center; color:#fff; text-shadow:1px 1px 1px #000"> <?= $result ?></div>
    </body>

    </html>