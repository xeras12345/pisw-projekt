<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <link rel="stylesheet" href="potwierdzenierezerwacji.css" type="text/css">
  <script src="script.js"></script>
  <script src="rezerwacja.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");
require_once "connect.php";

function pobierzZamowienieHistoryczne($link) {  
    $sql = "SELECT * FROM zamowienia WHERE status='zakończone' ORDER BY datazamowienia DESC";
    if($stmt = mysqli_prepare($link, $sql)){
        
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

if (!isset($_POST["action"])) {
    echo '<script>window.location = "home.php"</script>';
} else if ($_POST["action"] == 1){
    echo '
        <form id="form" action="adminzamowienia.php" method="post">
        <input type="hidden" value="'.$_POST["action"].'" name="action" id="formaction">
        <input type="hidden" value="'.$_POST["id"].'" name="id" id="formid">
        </form>
    
        <div class="section group">
    
        <div class="col span_12_of_12">
        </div>
    
        </div>
    
        <div class="section group">
    
            <div class="col span_12_of_12">
                <p class="sectionTextBold"> Czy na pewno chcesz zmienić status zamówienia na zakończone? </p>
            </div>
    
        </div>
        
        <div class="section group">
    
        <div class="col span_5_of_12">
        </div>
    
        <div class="col span_1_of_12">
            <a><p class="sectionTextBold textMenu" onclick="formSubmit()">
            Tak
            </p></a>
        </div>
    
        <div class="col span_1_of_12">
        <a><p class="sectionTextBold textMenu" onclick=goBack()> Nie </p></a>
        </div>
    
        <div class="col span_5_of_12">
        </div>
    
        </div>';

}
    else if ($_POST["action"] == 2) {
        $zamowienie = pobierzZamowienieHistoryczne($link);
        echo '
        <form id="form" action="adminzamowienia.php" method="post">
        <input type="hidden" value="'.$_POST["action"].'" name="action" id="formaction">
        <input type="hidden" value="'.$_POST["id"].'" name="id" id="formid">
        </form>
    
        <div class="section group">
    
        <div class="col span_12_of_12">
        </div>
    
        </div>
    
        <div class="section group">
    
            <div class="col span_12_of_12">
                <p class="sectionTextBold"> Czy na pewno chcesz anulować zamówienie? </p>
            </div>
    
        </div>
        
        <div class="section group">
    
        <div class="col span_5_of_12">
        </div>
    
        <div class="col span_1_of_12">
            <a><p class="sectionTextBold textMenu" onclick="formSubmit()">
            Tak
            </p></a>
        </div>
    
        <div class="col span_1_of_12">
        <a><p class="sectionTextBold textMenu" onclick=goBack()> Nie </p></a>
        </div>
    
        <div class="col span_5_of_12">
        </div>
    
        </div>';
    
    }
?>


<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>