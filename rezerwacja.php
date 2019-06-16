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
$link->query('SET NAMES utf8');
$link->query('SET CHARACTER_SET utf8_unicode_ci');

function pobierzRezerwacje($link) { 
    $sql = "SELECT * FROM bookings WHERE DATE(bdate) BETWEEN DATE(CURRENT_DATE()) AND DATE(CURRENT_DATE() + INTERVAL 7 DAY)
    AND id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $_POST["id"]);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);  
        } else {
            echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
        }
    } else {
        echo "Coś nie tak z sql squery: " . mysqli_error($link);
    }
    mysqli_stmt_bind_result($stmt, $id, $bdate, $btime, $tableid, $bname, $phone, $email);
    while (mysqli_stmt_fetch($stmt)) {
        $rezerwacje = array("id" => $id, "bdate" => $bdate, "btime" => $btime, "tableid" => $tableid, "bname" => $bname, "phone" => $phone, "email" => $email);
    }
    mysqli_stmt_close($stmt);
    return $rezerwacje;
}

if (!isset($_POST["action"])) {
    echo '<script>window.location = "home.php"</script>';
} else if ($_POST["action"] == 1) {
    $rezerwacja = pobierzRezerwacje($link);
    echo '
    <div class="section group">

    <div class="col span_2_of_12">
    </div>
    <div class="col span_4_of_12">
        <p class="sectionTitle">REZERWACJA:</p>
        <p class="sectionTextBold">Numer stolika: '.$rezerwacja["tableid"].'</p>
        <p class="sectionTextBold">Dzień rezerwacji: '.substr($rezerwacja["bdate"],8,2).'.'.substr($rezerwacja["bdate"],5,2).'</p>
        <p class="sectionTextBold">Godzina: '.substr($rezerwacja["btime"],0,5).'</p>
    </div>
    <div class="col span_3_of_12">
        <p class="sectionTitle">DANE:</p>
        <form id="form" action="twojekonto.php" method="post">
        <input type="hidden" value="'.$_POST["action"].'" name="action" id="formaction">
        <input type="hidden" value="'.$_POST["id"].'" name="id" id="formid">
        <label><p class="sectionTextBold">Imie i nazwisko: </p></label>
        <input type="text" name="name" id="name" value="'.$rezerwacja["bname"].'" required><br>
        <label><p class="sectionTextBold">Numer telefonu: </p></label>
        <input type="tel" pattern="[0-9]{9}" name="tel" id="tel" value='.$rezerwacja["phone"].' required><br>
        </form>
    </div>
    <div class="col span_3_of_12">
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
} else if ($_POST["action"] == 2) {
    echo '
    <form id="form" action="twojekonto.php" method="post">
    <input type="hidden" value="'.$_POST["action"].'" name="action" id="formaction">
    <input type="hidden" value="'.$_POST["id"].'" name="id" id="formid">
    </form>

    <div class="section group">

    <div class="col span_12_of_12">
    </div>

    </div>

    <div class="section group">

        <div class="col span_12_of_12">
            <p class="sectionTextBold"> Czy na pewno chcesz anulować rezerwację? </p>
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