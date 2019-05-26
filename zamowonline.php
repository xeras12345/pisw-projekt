<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <script src="script.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");
require_once "connect.php";

function pobierzDaniazKategorii($kategoria, $link) { 
    $sql = 'SELECT id, kategoria, nazwa, sklad, cena FROM menu WHERE kategoria = ? AND dostepnosc = 1';
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $kategoria);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);  
        } else {
            echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
        }
    } else {
        echo "Coś nie tak z sql squery: " . mysqli_error($link);
    }
    mysqli_stmt_bind_result($stmt, $id, $kategoria, $nazwa, $sklad, $cena);
    $dania = array();
    while (mysqli_stmt_fetch($stmt)) {
        array_push($dania, array("id" => $id, "kategoria" => $kategoria, "nazwa" => $nazwa, "sklad" => $sklad, "cena" => $cena));
    }
    mysqli_stmt_close($stmt);
    return $dania;
}

function wyswietlDania($dania) {
    foreach ($dania as $danie) {
        echo '
        <div class="section group">
        <div class="col span_2_of_12">
        </div>
        <div class="col span_5_of_12">
            <p class="sectionTextBold textMenu">'.strtoupper($danie["nazwa"]).'</p>
            <p class="textMenu">'.$danie["sklad"].'</p>
        </div>
        <div class="col span_2_of_12">
        <p class="sectionTextBold textMenu">'.$danie["cena"].' zł</p>
        </div>
        <div class="col span_1_of_12">
        <p class="sectionTextBold textMenu">Dodaj</p>
        </div>
        <div class="col span_1_of_12">
        </div>
        </div>';
    }
}
?>

<section>
<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">PRZYSTAWKI</p>
    </div>

</div>
<?php
wyswietlDania(pobierzDaniazKategorii("przystawki",$link))
?> 
</section>

<section>
<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">ZUPY</p>
    </div>

</div>
<?php
wyswietlDania(pobierzDaniazKategorii("zupy",$link))
?> 
</section>

<section>
<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">DANIA GŁÓWNE</p>
    </div>

</div>
<?php
wyswietlDania(pobierzDaniazKategorii("dania",$link))
?> 
</section>
<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>