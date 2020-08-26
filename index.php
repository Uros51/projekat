<?php
require("connection.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
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

<a href="exportmenu.php" class="btn navitem float-right">Istampaj meni</a>
<a href="adddrink.php" class="btn navitem float-right">Dodaj pice</a>
<a href="addfood.php" class="btn navitem float-right">Dodaj jelo</a>

<?php } ?>
<a href="index.php" class="btn navitem float-right">Pocetna stranica</a>

</div>

</div>
<div class="row menu">

<div class="col-md-6">
<div class="row">
<div class="col-md-12">
<h1>Pica u ponudi: 
</h1>
<div class="row">

<div class="col-md-12 filterDrink">
    <form class="form-inline">
<div class="form-group">
    <label for="exampleInputEmail1">Min. cijena: </label>
    <select class="form-control ml-2" id="minPriceDrink"><option value="1">1 &euro;</option><option value="1.5">1.5 &euro;</option><option value="2">2 &euro;</option><option value="2.5">2.5 &euro;</option></select>
</div>
<div class="form-group ml-2">
    <label for="exampleInputEmail1">Max. cijena: </label>
    <select class="form-control ml-2" id="maxPriceDrink"><option value="3">3 &euro;</option><option value="4">4 &euro;</option><option value="15">15 &euro;</option><option selected value="9">9 &euro;</option></select>
</div>
<div class="form-group ml-2">
    <label for="exampleInputEmail1">Pretrazi po nazivu: </label>
    <input type="search ml-2" class="form-control" placeholder="Unesi naziv" id="searchDrink">
</div>
        </form>
</div>
</div>
<div class="row drinklist">
<?php 
    $drink = $conn->query("select * from pice");
    $i = 0;
    while($drinkItem = $drink->fetch_assoc()){
        ?>
        <div class="menuitem col-md-12">
        <span style="font-weight:bold;" class="float-left"><?php echo $drinkItem['naziv'];?></span> <span class="ml-2">(<?php echo $drinkItem['litara'];?> litara)</span>
        <span class="float-right"><?php echo number_format($drinkItem['cijena'], 2);?> &euro;
        <?php if($_SESSION['admin'] == 1){
        ?>
        <a class='deleteDrink' style='color:black;' href="deletedrink.php?id=<?php echo $drinkItem['id'];?>" class="ml-2"><i class="fas fa-trash"></i></a>  
        <a style='color:black;' href="editdrink.php?id=<?php echo $drinkItem['id'];?>" class="ml-2"><i class="fas fa-edit"></i></i></a> 
        <?php
        }
        ?>
         </span>
        
          
    </div>
        <?php
        if(($i + 1) % 3 == 0){
            echo "<div class='col-md-12'><br><hr><br></div>";
        }
        $i++;
    }
?>
</div>
</div>
</div>
</div>


<div class="col-md-6">
<div class="row">
<div class="col-md-12">
<h1>Jela u ponudi:</h1>
<div class="row">

<div class="col-md-12 filterFood">
    <form class="form-inline">
<div class="form-group">
    <label for="exampleInputEmail1">Min. cijena: </label>
    <select class="form-control ml-2" id="minPriceFood"><option value="1">1 &euro;</option><option value="1.5">1.5 &euro;</option><option value="2">2 &euro;</option><option value="2.5">2.5 &euro;</option></select>
</div>
<div class="form-group ml-2">
    <label for="exampleInputEmail1">Max. cijena: </label>
    <select class="form-control ml-2" id="maxPriceFood"><option value="3">3 &euro;</option><option value="4">4 &euro;</option><option value="5">5 &euro;</option><option selected value="15">15 &euro;</option></select>
</div>
<div class="form-group ml-2">
    <label for="exampleInputEmail1">Pretrazi po nazivu: </label>
    <input type="search ml-2" class="form-control" placeholder="Unesi naziv" id="searchFood">
</div>
        </form>
</div>
</div>
<div class="row foodlist">
<?php 
    $food = $conn->query("select * from jelo");
    $i = 0;
    while($foodItem = $food->fetch_assoc()){
        ?>
        <div class="menuitem col-md-12">
        <span style="font-weight:bold;" class="float-left"><?php echo $foodItem['naziv'];?></span> <span class="ml-2">(<?php echo $foodItem['gramaza'];?> gr)</span>
        <span class="float-right"><?php echo number_format($foodItem['cijena'], 2);?> &euro;
        <?php if($_SESSION['admin'] == 1){
        ?>
        <a class='deleteFood' style='color:black;' href="deletefood.php?id=<?php echo $foodItem['id'];?>" class="ml-2"><i class="fas fa-trash"></i> </a> 
        <a style='color:black;' href="editfood.php?id=<?php echo $foodItem['id'];?>" class="ml-2"><i class="fas fa-edit"></i> </a>
        <?php
        }
        ?>
        </span>
        </div>
        <?php
        if(($i + 1) % 5 == 0){
            echo "<div class='col-md-12'><br><hr><br></div>";
        }
        $i++;
    }
?>
</div>
</div>
</div>
</div>
</div>

</div>

<script>

    function filterDrink(){
        var minPrice = $("#minPriceDrink").val();
        var maxPrice = $("#maxPriceDrink").val();
        var search = $("#searchDrink").val();

        $.get( "filterdrink.php", {minPrice: minPrice, maxPrice: maxPrice, search: search}, function( data ) {
             $(".drinklist").html(data);
             $('.deleteDrink').unbind( "click" );
            $('.deleteDrink').on('click', deleteDrink);
        });
    }

    function filterFood(){
        var minPrice = $("#minPriceFood").val();
        var maxPrice = $("#maxPriceFood").val();
        var search = $("#searchFood").val();

        $.get( "filterfood.php", {minPrice: minPrice, maxPrice: maxPrice, search: search}, function( data ) {
             $(".foodlist").html(data);
             $('.deleteFood').unbind( "click" );
            $('.deleteFood').on('click', deleteFood);
        });
    }

    function deleteDrink(event){
        event.preventDefault();
             var shouldDelete = confirm("Da li ste sigurni?");
             if(shouldDelete == false){
                 return;
             }
            $.get( $(this).attr("href"), function( data ) {
             if(data != -1){
                 filterDrink();
             }else{
                 alert("Greska prilikom brisanja pica");
             }
            });
    }

    function deleteFood(event){
        event.preventDefault();
             var shouldDelete = confirm("Da li ste sigurni?");
             if(shouldDelete == false){
                 return;
             }
            $.get( $(this).attr("href"), function( data ) {
             if(data != -1){
                 filterFood();
             }else{
                 alert("Greska prilikom brisanja pica");
             }
            });
    }


    $( document ).ready(function() {
        $("#minPriceDrink, #maxPriceDrink").on('change', function() {
             filterDrink();
        })

        $("#minPriceFood, #maxPriceFood").on('change', function() {
            filterFood();
        })

         $('#searchDrink').keyup(function() {
             filterDrink();
         });

          $('#searchFood').keyup(function() {
             filterFood();
         });


         $('.deleteDrink').on('click', deleteDrink);

         $('.deleteFood').on('click', deleteFood);

        
    });

</script>
</body>
</html>