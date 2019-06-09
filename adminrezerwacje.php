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
  <script src="twojekonto.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");
include("wymaganyadmin.php");

function pobierzRezerwacje($link) { 
    $sql = "SELECT * FROM bookings WHERE DATE(bdate) BETWEEN DATE(CURRENT_DATE()) AND DATE(CURRENT_DATE() + INTERVAL 7 DAY)
    ORDER BY bdate, btime";
    if($stmt = mysqli_prepare($link, $sql)){
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);  
        } else {
            echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
        }
    } else {
        echo "Coś nie tak z sql squery: " . mysqli_error($link);
    }
    mysqli_stmt_bind_result($stmt, $id, $bdate, $btime, $tableid, $bname, $phone, $email);
    $rezerwacje = array();
    while (mysqli_stmt_fetch($stmt)) {
        array_push($rezerwacje, array("id" => $id, "bdate" => $bdate, "btime" => $btime, "tableid" => $tableid, "bname" => $bname, "phone" => $phone, "email" => $email));
    }
    mysqli_stmt_close($stmt);
    return $rezerwacje;
}

function wyswietlRezerwacje($rezerwacje) {
    $action1 = 1;
    $action2 = 2;
    foreach ($rezerwacje as $rezerwacja) {
        echo '
        <div class="section group">

        <div class="col span_1_of_12">
            <p class="textRezerwacje">'.substr($rezerwacja["bdate"],8,2).'.'.substr($rezerwacja["bdate"],5,2).'</p>
        </div>
        <div class="col span_1_of_12">
            <p class="textRezerwacje">'.substr($rezerwacja["btime"],0,5).'</p>
        </div>
        <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$rezerwacja["tableid"].'</p>
        </div>
        <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$rezerwacja["bname"].'</p>
        </div>
        <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$rezerwacja["phone"].'</p>
        </div>
        <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$rezerwacja["email"].'</p>
        </div>
        <div class="col span_2_of_12">
            <a><p class="textRezerwacje" onclick="formSubmit('.$action1.','.$rezerwacja["id"].')">Edytuj dane</p></a>
            <a><p class="textRezerwacje" onclick="formSubmit('.$action2.','.$rezerwacja["id"].')">Anuluj rezerwację</p></a>
        </div>
    
        </div>';
    }
}

if (isset($_POST["action"])) {
    if ($_POST["action"] == 1) {
        $sql = 'UPDATE bookings SET bname="'.$_POST["name"].'", phone="'.$_POST["tel"].'" WHERE id='.$_POST["id"];
        if (mysqli_query($link, $sql)) {
            echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie zaktualizowano rezerwację.</p>
                </div>
        
            </div>';
         } else {
            echo "Error updating record: " . mysqli_error($link);
         }
    } else if ($_POST["action"] == 2) {
        $sql = 'DELETE FROM bookings WHERE id='.$_POST["id"];
        if (mysqli_query($link, $sql)) {
            echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie anulowano rezerwację.</p>
                </div>
        
            </div>';
        } else {
            echo "Error deleting record: " . mysqli_error($link);
        }
    }
}
?>

<section>

<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">REZERWACJE</p>
    </div>

</div>

<div class="section group">

    <div class="col span_1_of_12">
        <p class="sectionTextBold">Data</p>
    </div>
    <div class="col span_1_of_12">
        <p class="sectionTextBold">Godzina</p>
    </div>
    <div class="col span_2_of_12">
        <p class="sectionTextBold">Numer stolika</p>
    </div>
    <div class="col span_2_of_12">
        <p class="sectionTextBold">Imię i nazwisko</p>
    </div>
    <div class="col span_2_of_12">
        <p class="sectionTextBold">Telefon</p>
    </div>
    <div class="col span_2_of_12">
        <p class="sectionTextBold">Email</p>
    </div>
    <div class="col span_2_of_12">
    </div>

</div>

<?php
wyswietlRezerwacje(pobierzRezerwacje($link))
?> 
</section>

<form id="form" action="rezerwacja.php" method="post">
    <input type="hidden" name="action" id="formaction">
    <input type="hidden" name="id" id="formid">
</form>

<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>