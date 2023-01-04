<?php

$db = new SQLite3('database.db');

$product = $db->query("SELECT * FROM products");


?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=yes">
            <link rel="stylesheet" href="bootstrap.min.css">

        <title>test</title>
   
    
    </head>
    <body style="background-color: #343541;">
        
        <div class="container text-white">
          
            
        <h2>Products</h2>
        <table class="table table-bordered table-dark">
           
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
            </tr>
            
        <?php
        while ($row = $product->fetchArray()) {
            echo "<tr>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td>".$row["stock"]."</td>";
            echo "</tr>";
        }
        ?>

        </table>
        
        <h2>Buy Products</h2>
<form action="" method="POST">
  <div class="form-group">
    <label for="productName">Product name</label>
    <input type="text" id="productName" class="form-control" name="name" placeholder="Product Name">
  </div>
  <div class="form-group">
    <label for="productPrice">Price</label>
    <input type="number" name="money" class="form-control" id="productPrice" placeholder="Price">
  </div>
  <button type="submit" name="submit" class="btn btn-secondary m-3 px-4">Buy</button>

</form>
        
        <?php
    if (isset($_POST['submit'])){
        while ($row = $product->fetchArray()) {
            if ($row['name'] == $_POST['name']){
               $price = $row['price'];
               $money = $_POST['money'];
               if ($money >= $price){
                   $item = $_POST['name'];
                   $total = $money - $price;
                   $newstock = $row["stock"] - 1;
                   $db->query("UPDATE products SET stock='$newstock' WHERE name='$item'");
                   echo "<p>Transaction Successful</p>";
                   echo "<p>Change: ".$total."</p>";
               }else{
                   echo "Insufficient Money";
           }
        }
      }
    }
        ?>
        </div>
       
 
<script src="bootstrap.bundle.min.js"></script>
    </body>
</html>
