<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Koszyk</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <script src="script.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
 
</head>
 
<body>

<?php include("header.php"); 
      include("wymaganylogin.php");
      require_once "connect.php";
      $link->query("SET NAMES 'utf8'");
?>
<?php
function pobierzZamowienie($link) {  
    $sql = "SELECT * FROM zamowienia WHERE 
    email = ? ORDER BY id DESC LIMIT 1";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["email1"]);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);  
        } else {
            echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
        }
    } else {
        echo "Coś nie tak z sql squery: " . mysqli_error($link);
    }
    mysqli_stmt_bind_result($stmt, $id, $email, $kwota, $produkty, $adres, $miasto, $numer, $uwagi, $status, $datazamowienia);
    $zamowienia = array();
    while (mysqli_stmt_fetch($stmt)) {
        array_push($zamowienia, array("id" => $id, "email" => $email, "kwota" => $kwota,"produkty" => $produkty, "adres" => $adres, "miasto" => $miasto, "numer" => $numer, "uwagi" => $uwagi, "status" => $status, "datazamowienia" => $datazamowienia));
    }
    mysqli_stmt_close($stmt);
    return $zamowienia;

} 

function wyswietlZamowienia($zamowienia) {

  foreach ($zamowienia as $zamowienie) {
    echo($zamowienie["email"]);
  }
}
function wyswietlZamowienia2($zamowienia) {

  foreach ($zamowienia as $zamowienie) {
    echo($zamowienie["adres"]);
  }
}
function wyswietlZamowienia3($zamowienia) {

  foreach ($zamowienia as $zamowienie) {
    echo($zamowienie["miasto"]);
  }
}
function wyswietlZamowienia4($zamowienia) {

  foreach ($zamowienia as $zamowienie) {
    echo($zamowienie["numer"]);
  }
}
function wyswietlZamowienia5($zamowienia) {

  foreach ($zamowienia as $zamowienie) {
    echo($zamowienie["kwota"]);
  }
}
?>
<?php 
if(!empty($_SESSION["cart"])){
                $outall = '';
                foreach ($_SESSION["cart"] as $key => $value) {
                  echo'<a href="zamowonline.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span id="click"></span></a>';
                }
              }

?>
<?php

 
?> 
<div id="potwierdzenie" class="section">

    <p class="sectionTitle">Szczegóły twojego zamówienia</p>
 
    <div class="col span_4_of_12"></div>
    <div class="col span_4_of_12">
          <p  class="textMenu" style="font-weight: bold;">Adres: <?php wyswietlZamowienia2(pobierzZamowienie($link))?> </p>
          <p  class="textMenu" style="font-weight: bold;">Email: <?php wyswietlZamowienia(pobierzZamowienie($link))?></p>
          <p  class="textMenu" style="font-weight: bold;">Numer telefonu: <?php wyswietlZamowienia4(pobierzZamowienie($link))?></p>
          <p  class="textMenu" style="font-weight: bold;">Kwota przy odbiorze: <?php wyswietlZamowienia5(pobierzZamowienie($link))?> zł</p>
          <p  class="textMenu" style="font-weight: bold;">Oczekiwany czas realizacji to: 45min-1h</p>

    </div>
    <div class="col span_4_of_12"></div>

        
</div>
<div class="section">

</div>


 




 <script>
   function usun()
   {
    document.getElementById('click').click();
   }
 </script>


 

 
</body>
<?php include("footer.php"); ?>
</html>