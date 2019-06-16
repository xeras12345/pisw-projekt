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
  <script src="adminmenu.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");
include("wymaganyadmin.php");
$link->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

function pobierzDaniazKategorii($kategoria, $link) { 
    $sql = 'SELECT * FROM menu WHERE kategoria = ?';
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
    mysqli_stmt_bind_result($stmt, $id, $kategoria, $nazwa, $sklad, $cena, $dostepnosc);
    $dania = array();
    while (mysqli_stmt_fetch($stmt)) {
        array_push($dania, array("id" => $id, "kategoria" => $kategoria, "nazwa" => $nazwa, "sklad" => $sklad, "cena" => $cena, "dostepnosc" => $dostepnosc));
    }
    mysqli_stmt_close($stmt);
    return $dania;
}

function dostepny($danie) {
    if ($danie["dostepnosc"] == 1) {
        return "DOSTĘPNY";
    } else {
        return "NIEDOSTĘPNY";
    }
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
        <div class="col span_1_of_12">
        <p class="sectionTextBold textMenu">'.$danie["cena"].' zł</p>
        </div>
        <div class="col span_2_of_12">
        <p class="sectionTextBold textMenu">'.dostepny($danie).'</p>
        </div>
        <div class="col span_1_of_12">
        <a><p class="sectionTextBold textMenu" onclick="submitForm('.$danie["id"].',1)">Edytuj</p></a>
        <a><p class="sectionTextBold textMenu" onclick="submitForm('.$danie["id"].',2)">Usuń</p></a>
        </div>
        <div class="col span_1_of_12">
        </div>
        </div>';
    }
}

if (isset($_POST["action"])) {
    if ($_POST["action"] == 1) {
        $sql = 'UPDATE menu SET kategoria="'.$_POST["kategoria"].'", nazwa="'.$_POST["nazwa"].'", sklad="'.$_POST["sklad"].'", 
        cena="'.$_POST["cena"].'", dostepnosc="'.$_POST["dostepnosc"].'" WHERE id='.$_POST["id"];
        if (mysqli_query($link, $sql)) {
            echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie zaktualizowano pozycję w menu.</p>
                </div>
        
            </div>';
         } else {
            echo "Error updating record: " . mysqli_error($link);
         }
    } else if ($_POST["action"] == 2) {
        $sql = 'DELETE FROM menu WHERE id='.$_POST["id"];
        if (mysqli_query($link, $sql)) {
            echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie usunięto pozycję menu.</p>
                </div>
        
            </div>';
        } else {
            echo "Error deleting record: " . mysqli_error($link);
        } 

    } else if ($_POST["action"] == 3) {
        $sql = 'INSERT INTO menu (kategoria, nazwa, sklad, cena, dostepnosc) VALUES ("'.$_POST["kategoria"].'", "'.$_POST["nazwa"].'",
         "'.$_POST["sklad"].'", "'.$_POST["cena"].'", "'.$_POST["dostepnosc"].'")';
        if (mysqli_query($link, $sql)) {
            echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie dodano pozycję menu.</p>
                </div>
        
            </div>';
        } else {
            echo "Error deleting record: " . mysqli_error($link);
        } 
}
}
?>

<form action="danie.php" method="post" id="form">
    <input type="hidden" name="id" id="formid">
    <input type="hidden" name="action" id="formaction">
</form>

<form action="dodajdanie.php" method="post" id="form2">
    <input type="hidden" name="kategoria" id="formkategoria">
</form>

<section>
<div class="section group">
    <div class="col span_12_of_12">
        <p class="sectionTitle">PRZYSTAWKI</p>
    </div>
</div>
<?php
wyswietlDania(pobierzDaniazKategorii("przystawki",$link))
?> 
<div class="section group">
    <div class="col span_12_of_12">
        <a><p id="dodajpozycje" class="sectionTextBold textMenu" onclick='submitForm2("przystawki")'>Dodaj nową pozycję</p></a>
    </div>
</div>
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
<div class="section group">
    <div class="col span_12_of_12">
        <a><p id="dodajpozycje" class="sectionTextBold textMenu" onclick='submitForm2("zupy")'>Dodaj nową pozycję</p></a>
    </div>
</div> 
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
<div class="section group">
    <div class="col span_12_of_12">
        <a><p id="dodajpozycje" class="sectionTextBold textMenu" onclick='submitForm2("dania")'>Dodaj nową pozycję</p></a>
    </div>
</div> 
</section>
<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>