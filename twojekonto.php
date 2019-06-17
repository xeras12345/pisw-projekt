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
include("wymaganylogin.php");
require_once "connect.php";
$link->query('SET NAMES utf8');
$link->query('SET CHARACTER_SET utf8_unicode_ci');

function czyAdmin($link) {
    $sql = 'SELECT id, email, isadmin FROM users WHERE email = ?';
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['email1']);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);  
            } else {
                echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
            }
        } else {
            echo "Coś nie tak z sql squery: " . mysqli_error($link);
        }
        mysqli_stmt_bind_result($stmt, $id, $email, $isadmin1);
        while (mysqli_stmt_fetch($stmt)) {
            $isadmin = $isadmin1;
        }
        mysqli_stmt_close($stmt);
        return $isadmin;
    }

if (czyAdmin($link) == 1) {
echo '<script>window.location = "admin.php"</script>';
    }
?>

<?php
function pobierzRezerwacje($link) { 
    $sql = "SELECT * FROM bookings WHERE DATE(bdate) BETWEEN DATE(CURRENT_DATE()) AND DATE(CURRENT_DATE() + INTERVAL 7 DAY)
    AND email = ?";
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
    mysqli_stmt_bind_result($stmt, $id, $bdate, $btime, $tableid, $bname, $phone, $email);
    $rezerwacje = array();
    while (mysqli_stmt_fetch($stmt)) {
        array_push($rezerwacje, array("id" => $id, "bdate" => $bdate, "btime" => $btime, "tableid" => $tableid, "bname" => $bname, "phone" => $phone, "email" => $email));
    }
    mysqli_stmt_close($stmt);
    return $rezerwacje;
}
function pobierzZamowienieHistoryczne($link) {  
    $sql = "SELECT * FROM zamowienia WHERE 
    email = ? AND status ='zakończone' ORDER BY datazamowienia DESC";
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
function pobierzZamowienieAktualne($link) {  
    $sql = "SELECT * FROM zamowienia WHERE 
    email = ? AND status ='oczekiwane' ORDER BY datazamowienia DESC";
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
function wyswietlZamowieniaHistoryczne($zamowienia) {
    foreach ($zamowienia as $zamowienie) {
        echo'<div class="section group">
        </div>
            <div class="col span_1_of_12"></div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["datazamowienia"].'</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["kwota"].' zł</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["adres"].' '.$zamowienie["miasto"].'</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["produkty"].'</p>
            </div>
            <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$zamowienie["status"].'</p>
            </div>
            <div class="col span_1_of_12"></div>
    
    </div>';
    
}
}
function wyswietlZamowieniaAktualne($zamowienia) {
    foreach ($zamowienia as $zamowienie) {
        echo'<div class="section group">
        </div>
            <div class="col span_1_of_12"></div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["datazamowienia"].'</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["kwota"].' zł</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["adres"].' '.$zamowienie["miasto"].'</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">'.$zamowienie["produkty"].'</p>
            </div>
            <div class="col span_2_of_12">
            <p class="textRezerwacje">'.$zamowienie["status"].'</p>
            </div>
            <div class="col span_1_of_12"></div>
    
    </div>';
    
}
}


function wyswietlRezerwacje($rezerwacje) {
    $action1 = 1;
    $action2 = 2;
    foreach ($rezerwacje as $rezerwacja) {
        echo '
        <div class="section group">

        <div class="col span_2_of_12">
            <p class="textRezerwacje">'.substr($rezerwacja["bdate"],8,2).'.'.substr($rezerwacja["bdate"],5,2).'</p>
        </div>
        <div class="col span_2_of_12">
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
        <p class="sectionTitle">TWOJE REZERWACJE</p>
    </div>

</div>

<div class="section group">

    <div class="col span_2_of_12">
        <p class="sectionTextBold">Data</p>
    </div>
    <div class="col span_2_of_12">
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
        <p class="sectionTextBold">Akcja</p>
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
<section>
<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">AKTUALNE ZAMÓWIENIA</p>
    </div>
</div>
<div class="section group">
    </div>
        <div class="col span_1_of_12"></div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Data</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Kwota</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Adres</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Produkty</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Status zamówienia</p>
        </div>
        <div class="col span_1_of_12"></div>

</div>
<?php
wyswietlZamowieniaAktualne(pobierzZamowienieAktualne($link))
?>
</section>
<section>
<div class="section group">

    <div class="col span_12_of_12">
        <p class="sectionTitle">HISTORIA ZAMÓWIEŃ</p>
    </div>

</div>
<div class="section group">
    </div>
        <div class="col span_1_of_12"></div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Data</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Kwota</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Adres</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Produkty</p>
        </div>
        <div class="col span_2_of_12">
            <p class="sectionTextBold">Status zamówienia</p>
        </div>
        <div class="col span_1_of_12"></div>

</div>
<?php
wyswietlZamowieniaHistoryczne(pobierzZamowienieHistoryczne($link))
?>
</section> 
<div class="section group"></div>

<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>