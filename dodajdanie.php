<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <link rel="stylesheet" href="danie.css" type="text/css">
  <script src="script.js"></script>
  <script src="danie.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");

function selected($kategoria, $test) {
    if ($kategoria == $test) {
        return 'selected';
    } else {
        return '';
    }
}

if (!isset($_POST["kategoria"])) {
    echo '<script>window.location = "adminmenu.php"</script>';
} else {
    echo '
    <div class="section group">

    <div class="col span_4_of_12">
    </div>
    <div class="col span_4_of_12">
        <p class="sectionTitle">POZYCJA W MENU:</p>
        <form id="form" action="adminmenu.php" method="post">
        <input type="hidden" name="action" id="formaction" value="3">
        <label><p class="sectionTextBold">Kategoria: </p></label><br>
        <select name="kategoria" id="formkategoria">
        <option value="przystawki" '.selected("przystawki", $_POST["kategoria"]).'>Przystawki</option>
        <option value="zupy"'.selected("zupy", $_POST["kategoria"]).'>Zupy</option>
        <option value="dania"'.selected("dania", $_POST["kategoria"]).'>Dania</option>
        </select><br><br>
        <label><p class="sectionTextBold">Nazwa:</p></label><br>
        <input type="text" name="nazwa" id="formnazwa"><br><br>
        <label><p class="sectionTextBold">Skład: </p></label><br>
        <textarea rows="5" cols="50" name="sklad", id="formsklad"></textarea><br><br>
        <label><p class="sectionTextBold">Cena: </p></label><br>
        <input type="text" name="cena" id="forcena"><br><br>
        <label><p class="sectionTextBold">Dostępny: </p></label><br>
        <input type="radio" name="dostepnosc" value="1" checked="checked"> Tak<br>
        <input type="radio" name="dostepnosc" value="0"> Nie<br>
        </form>
    </div>
    <div class="col span_4_of_12">
    </div>
    
    </div>
    
    <div class="section group">

    <div class="col span_5_of_12">
    </div>

    <div class="col span_1_of_12">
        <a><p class="sectionTextBold textMenu" onclick="formSubmit()">
        Zatwierdź
        </p></a>
    </div>

    <div class="col span_1_of_12">
    <a><p class="sectionTextBold textMenu" onclick=goBack()> Anuluj </p></a>
    </div>

    <div class="col span_5_of_12">
    </div>

    </div>

    <div class="section group">

    <div class="col span_12_of_12" id="message">
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