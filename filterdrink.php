<?php 
    session_start();
    require("connection.php");

    $search = "";
    extract($_GET);

    $sql = "select * from pice where naziv like '$search%'";

    if(isset($minPrice)){
        $sql .= " and cijena >= $minPrice";
    }

    if(isset($maxPrice)){
        $sql .= " and cijena <= $maxPrice";
    }

    $drink = $conn->query($sql);
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
        if(($i + 1) % 3== 0){
            echo "<div class='col-md-12'><br><hr><br></div>";
        }
        $i++;
    }
?>