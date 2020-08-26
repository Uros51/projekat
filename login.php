<?php
require("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = $conn->query("select * from korisnik where username = '$username' and password = '$password'");
    if($res->num_rows > 0){
        $user = $res->fetch_assoc();
        $name = $user['ime'];
        $admin = $user['admin'];
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['admin'] = $admin;
        header("Location: index.php");
    }else{
        $loginError = "Netacan username ili password";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kafe Bar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"><script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="css/login.css" rel="stylesheet"></script>
</head>
<body>

<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

	<form class="form-signin" action="login.php" method="POST">
		<h1 class="form-signin-heading">Restoran Harmonija</h1>
        <?php if(isset($loginError)){
            ?>
                <p style="color:#c2b248;"><?php echo $loginError;?></p>
            <?php
        }
        ?>
		<input type="text" class="form-control" placeholder="Unesite username" name="username" required="required" autofocus="">
		<input type="password" class="form-control" name="password" placeholder="Unesite lozinku" required "required">
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Logujte se
		</button>
        <a href="register.php" style="color:white;">Stranica za registraciju</a>
	</form>

</div>
</body>
</html>