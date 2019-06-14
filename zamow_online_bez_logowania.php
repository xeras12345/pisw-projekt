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
    
    include("header.php");
    require_once "connect.php";




    ?>

</head>
<?php
        if(isset($_SESSION['email1'])){
            
            echo"<script> window.location = 'zamowonline.php'</script>";
        }
?>
<body>

        <div id="napisprzed" class="section group">
            <div class="col span_4_of_12"></div>
            <div class="col span_4_of_12"><h2>Aby złożyć zamówienie musisz być zalogowany</h2></div>
            <div class="col span_4 _of_12"></div>
        </div>


        <div class="section group">
            <div class="col span_5_of_12"></div>
            <div class="col span_3_of_12"><div class="niezalogowanyloguj" onclick="document.getElementById('modal-wrapper').style.display='block'"><input type="submit" value="Zaloguj się" ></div></div>
            <div class="col span_4_of_12"></div>
        </div>


 
    
</body>
<?php include("footer.php"); ?>
</html>