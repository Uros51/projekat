<?php
require("connection.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

if(!isset($_GET['id'])){
    header("Location: index.php");
}

$id = $_GET['id'];

$pice = $conn->query("select * from pice where id = $id")->fetch_assoc();
$stariNaziv = $pice['naziv'];
$staroLitara = $pice['litara'];
$staraCijena = $pice['cijena'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naziv = $_POST['naziv'];
    $litara = $_POST['litara'];
    $cijena = $_POST['cijena'];

    if($conn->query("update pice set naziv = '$naziv',litara = $litara,cijena = $cijena where id = $id")){
        echo "<script>
        alert('Uspjesno izmijenjeno pice');
        window.location.replace('index.php');
        </script>";
    }else{
        echo "<script>
        alert('Greska u izmjeni pica');
        </script>";
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
    <link href="css/index.css" rel="stylesheet"></script>
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

</head>
<body>

<div class="container-fluid">
<div class="row nav">
<div class="col-md-3">
<a href="#" class="btn navitem float-left">Dobrodosli, <?php echo $_SESSION['name'];?></a>
</div>
<div class="col-md-5 offset-md-4">
<a href="logout.php" class="btn navitem float-right">Odjavite se</a>

<?php if($_SESSION['admin'] == 1) {?>

<a href="adddrink.php" class="btn navitem float-right">Istampaj meni</a>
<a href="adddrink.php" class="btn navitem float-right">Dodaj pice</a>
<a href="addfood.php" class="btn navitem float-right">Dodaj jelo</a>

<?php } ?>
<a href="index.php" class="btn navitem float-right">Pocetna stranica</a>
</div>

</div>
<div class="row menu">

<div class="col-md-4 offset-md-4">
<form method="POST" id="form" action="editdrink.php?id=<?php echo $id;?>">
  <div class="form-group">
    <label for="naziv">Naziv pica</label>
    <input type="text" class="form-control" required value="<?php echo $stariNaziv;?>" name="naziv">
  </div>
  <div class="form-group">
    <label for="litara">Zapremina u litrima</label>
    <input type="number" step="0.01" min="0" class="form-control" required value="<?php echo $staroLitara;?>" name="litara">
  </div>
  <div class="form-group">
    <label for="cijena">Cijena u eurima</label>
    <input type="number" step="0.01" min="0" class="form-control" required value="<?php echo $staraCijena;?>" name="cijena">
  </div>

  <button type="submit" class="btn btn-warning form-control">Izmijeni pice</button>
</form>
</div>
</div>

</div>

<script>

   
</script>
</body>
</html>