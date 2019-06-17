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
    $link->query("SET NAMES 'utf8'");

    function pobierzZamowienieHistoryczne($link)
    {
        $sql = "SELECT * FROM zamowienia WHERE status='zakończone' ORDER BY datazamowienia DESC";
        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
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
            array_push($zamowienia, array("id" => $id, "email" => $email, "kwota" => $kwota, "produkty" => $produkty, "adres" => $adres, "miasto" => $miasto, "numer" => $numer, "uwagi" => $uwagi, "status" => $status, "datazamowienia" => $datazamowienia));
        }
        mysqli_stmt_close($stmt);
        return $zamowienia;
    }
    function pobierzZamowienieAktualne($link)
    {
        $sql = "SELECT * FROM zamowienia WHERE status = 'oczekiwane' ORDER BY datazamowienia DESC";
        if ($stmt = mysqli_prepare($link, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
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
            array_push($zamowienia, array("id" => $id, "email" => $email, "kwota" => $kwota, "produkty" => $produkty, "adres" => $adres, "miasto" => $miasto, "numer" => $numer, "uwagi" => $uwagi, "status" => $status, "datazamowienia" => $datazamowienia));
        }
        mysqli_stmt_close($stmt);
        return $zamowienia;
    }
    function wyswietlZamowieniaHistoryczne($zamowienia)
    {
        $action2 = 2;
        foreach ($zamowienia as $zamowienie) {
            echo '<div class="section group">
        </div>
            
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["datazamowienia"] . '</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["kwota"] . ' zł</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["adres"] . ' ' . $zamowienie["miasto"] . '</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["produkty"] . '</p>
            </div>
            <div class="col span_2_of_12">
            <p class="textRezerwacje">' . $zamowienie["status"] . '</p>
            </div>
            <div class="col span_2_of_12">
            <a><p class="textRezerwacje" onclick="formSubmit(' . $action2 . ',' . $zamowienie["id"] . ')">Usuń zamówienie</p></a>

            </div>
    
    </div>';
        }
    }
    function wyswietlZamowieniaAktualne($zamowienia)
    {
        $action1 = 1;
        $action2 = 2;
        foreach ($zamowienia as $zamowienie) {
            echo '<div class="section group">
        </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["datazamowienia"] . '</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["kwota"] . ' zł</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["adres"] . ' ' . $zamowienie["miasto"] . '</p>
            </div>
            <div class="col span_2_of_12">
                <p class="textRezerwacje">' . $zamowienie["produkty"] . '</p>
            </div>
            <div class="col span_2_of_12">
            <p class="textRezerwacje">' . $zamowienie["status"] . '</p>
            </div>
            <div class="col span_2_of_12">
            <a><p class="textRezerwacje" onclick="formSubmit(' . $action1 . ',' . $zamowienie["id"] . ')">Zmień status na zakończone</p></a>
            <a><p class="textRezerwacje" onclick="formSubmit(' . $action2 . ',' . $zamowienie["id"] . ')">Anuluj zamówienie</p></a>
            </div>
    
    </div>';
        }
    }



    if (isset($_POST["action"])) {
        if ($_POST["action"] == 1) {
            $sql = 'UPDATE zamowienia SET status="zakończone" WHERE id=' . $_POST["id"] . '';
            if (mysqli_query($link, $sql)) {
                echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie zaktualizowano status zamówienia.</p>
                </div>
        
            </div>';
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
        } else if ($_POST["action"] == 2) {
            $sql = 'DELETE FROM zamowienia WHERE id=' . $_POST["id"];
            if (mysqli_query($link, $sql)) {
                echo '
            <div class="section group">

            <div class="col span_12_of_12">
            </div>
        
            </div>
        
            <div class="section group">
        
                <div class="col span_12_of_12">
                    <p class="sectionTextBold">Pomyślnie anulowano zamówienie.</p>
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
                <p class="sectionTitle">AKTUALNE ZAMÓWIENIA</p>
            </div>
        </div>
        <div class="section group">
        </div>

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
            <p class="sectionTextBold">Status</p>
        </div>
        <div class="col span_2_of_12">
        </div>



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
            <p class="sectionTextBold">Status</p>
        </div>
        <div class="col span_2_of_12">
        </div>


        </div>
        <?php
        wyswietlZamowieniaHistoryczne(pobierzZamowienieHistoryczne($link))
        ?>
    </section>
    <div class="section group"></div>

    <form id="form" action="zamowienia_potwierdzenia.php" method="post">
        <input type="hidden" name="action" id="formaction">
        <input type="hidden" name="id" id="formid">
    </form>
    <?php
    include("footer.php");
    mysqli_close($link);
    ?>

</body>

</html>