<?php 
    session_start();
    require("connection.php");

    $search = "";
    extract($_GET);

    $sql = "select * from jelo where naziv like '$search%'";

    if(isset($minPrice)){
        $sql .= " and cijena >= $minPrice";
    }

    if(isset($maxPrice)){
        $sql .= " and cijena <= $maxPrice";
    }

    $food = $conn->query($sql);
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