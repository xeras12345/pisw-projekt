<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant Koszyk">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <script src="script.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">
  
    
          <?php
        if (isset($_POST['submitform']))
        {   
        
            echo("Zamówienie zostało złożone poprawnie, sprawdź szczegóły w swoim koncie!");
        } 
        ?>
    <?php
    
    
    include("header.php");
    require_once "connect.php";
    $link->query("SET NAMES 'utf8'"); //ustawienie kodowania
    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                  
                );
                $_SESSION["cart"][$count] = $item_array;
               
            }else{
 
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }
    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                
                    unset($_SESSION["cart"][$keys]);
    
                }
            }
        }
    
?>
 
 
</head>
<body>
 
<div style="width:100%;text-align:center;display:block;">
 
        <section>
        <div class="section group">
 
    <div class="col span_12_of_12">
        <p class="sectionTitle">PRZYSTAWKI</p>
    </div>
 
    </div>
        <?php
            $query = "SELECT * FROM menu WHERE `kategoria` = 'przystawki' ORDER BY id ASC";
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
 
                            
                    ?>          <div class="section group">
                                <form method="post" action="zamowonline.php?action=add&id=<?php echo $row["id"]; ?>">
                                <div class="col span_2_of_12"></div>
                                <div class="col span_4_of_12" ><h5 class="sectionTextBold textMenu"><?php echo strtoupper($row["nazwa"]); ?></h5>
                                <p class="textMenu"><?php echo $row["sklad"]; ?></p></div>
                                <div class="col span_2_of_12"><h5><?php echo $row["cena"]; ?>zł</h5></div>
                                <div class="col span_1_of_12" style="margin-top:35px"><input type="number" name="quantity" value="1" min="1" max="30"></div>
                                <div class><input type="hidden" name="hidden_name" value="<?php echo $row["nazwa"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["cena"]; ?>"></div>
                                <div class="col span_2_of_12"><input type="submit" name="add" class="btn"value="Dodaj">
                            
                                </form>
                                </div>
                                <div class="col span_1_of_12"></div>
                                </div>
                    <?php
                }
            }
        ?>
        </section>
        <section>
        <div class="section group">
 
    <div class="col span_12_of_12">
        <p class="sectionTitle">ZUPY</p>
    </div>
 
    </div>
        <?php
            $query = "SELECT * FROM menu WHERE `kategoria` = 'zupy' ORDER BY id ASC";
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
 
                            
                    ?>          <div class="section group">
                                <form method="post" action="zamowonline.php?action=add&id=<?php echo $row["id"]; ?>">
                                <div class="col span_2_of_12"></div>
                                <div class="col span_4_of_12" ><h5 class="sectionTextBold textMenu"><?php echo strtoupper($row["nazwa"]); ?></h5>
                                <p class="textMenu"><?php echo $row["sklad"]; ?></p></div>
                                <div class="col span_2_of_12"><h5><?php echo $row["cena"]; ?>zł</h5></div>
                                <div class="col span_1_of_12" style="margin-top:35px"><input type="number" name="quantity" value="1" min="1" max="30"></div>
                                <div class><input type="hidden" name="hidden_name" value="<?php echo $row["nazwa"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["cena"]; ?>"></div>
                                <div class="col span_2_of_12"><input type="submit" name="add" class="btn"value="Dodaj">
                            
                                </form>
                                </div>
                                <div class="col span_1_of_12"></div>
                                </div>
                    <?php
                }
            }
        ?>
        </section>
 
        <section>
        <div class="section group">
 
    <div class="col span_12_of_12">
        <p class="sectionTitle">DANIA</p>
    </div>
 
    </div>
        <?php
            $query = "SELECT * FROM menu WHERE `kategoria` = 'dania' ORDER BY id ASC";
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
 
                            
                    ?>          <div class="section group">
                                <form id="myForm" method="post" action="zamowonline.php?action=add&id=<?php echo $row["id"]; ?>">
                                <div class="col span_2_of_12"></div>
                                <div class="col span_4_of_12" ><h5 class="sectionTextBold textMenu"><?php echo strtoupper($row["nazwa"]); ?></h5>
                                <p class="textMenu"><?php echo $row["sklad"]; ?></p></div>
                                <div class="col span_2_of_12"><h5><?php echo $row["cena"]; ?>zł</h5></div>
                                <div class="col span_1_of_12" style="margin-top:35px"><input type="number" name="quantity" value="1" min="1" max="30"></div>
                                <div class><input type="hidden" name="hidden_name" value="<?php echo $row["nazwa"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["cena"]; ?>"></div>
                                <div class="col span_2_of_12"><input type="submit" name="add" class="btn"value="Dodaj">
                            
                                </form>
                                </div>
                                <div class="col span_1_of_12"></div>
                                </div>
                    <?php
                }
            }
        ?>
        </section>
         </div>
         
            <?php
            $total = 0;
                if(!empty($_SESSION["cart"])){
                    
                    foreach ($_SESSION["cart"] as $key => $value) {
                    
 
                        
                        
                        
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                       
                    }
                        ?>
                        
                        
                        
                            
                        
                        <?php
                    }
                ?>
            </table>
            <div style="text-align: center">
            <form method="get" action="koszyk.php">
            <input type="hidden" name="total" value="total">
 
       
            <div class="box box--right">
  <div class="box__content">
    <div class="box__title">KOSZYK</div>
    <div class="box__description">
      <p style="text-align:center">Kwota zamówienia:</p>
      <div>
 
      <form>
      <p style="text-align:center">Suma:<?php echo number_format($total, 2); ?> zł </p></br>
      <input onclick="location.href='koszyk.php';" type="submit" class="btnkoszyk" value="Koszyk">
      <a href="zamowonline.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span>Wyczyść</span></a>
    </form>
</div>
    </div>
  </div>
</div>
            </form>
        </div>
 

   
 
 <?php include("footer.php"); ?>
</body>
</html