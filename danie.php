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
    require_once "connect.php";

    function pobierzDanie($id, $link)
    {
        $sql = 'SELECT * FROM menu WHERE id=?';
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            if (mysqli_stmt_execute($stmt)) {
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
            $danie = array("id" => $id, "kategoria" => $kategoria, "nazwa" => $nazwa, "sklad" => $sklad, "cena" => $cena, "dostepnosc" => $dostepnosc);
        }
        mysqli_stmt_close($stmt);
        return $danie;
    }

    function selected($kategoria, $danie)
    {
        if ($kategoria == $danie["kategoria"]) {
            return 'selected';
        } else {
            return '';
        }
    }

    function dostepny($test, $danie)
    {
        if ($danie["dostepnosc"] == $test) {
            return 'checked="checked"';
        } else {
            return "";
        }
    }

    if (!isset($_POST["action"])) {
        echo '<script>window.location = "home.php"</script>';
    } else if ($_POST["action"] == 1) {
        $danie = pobierzDanie($_POST["id"], $link);
        echo '
    <div class="section group">

    <div class="col span_4_of_12">
    </div>
    <div class="col span_4_of_12">
        <p class="sectionTitle">POZYCJA W MENU:</p>
        <form id="form" action="adminmenu.php" method="post">
        <input type="hidden" value="' . $_POST["action"] . '" name="action" id="formaction">
        <input type="hidden" value="' . $_POST["id"] . '" name="id" id="formid">
        <label><p class="sectionTextBold">Kategoria: </p></label><br>
        <select name="kategoria" id="formkategoria">
        <option value="przystawki" ' . selected("przystawki", $danie) . '>Przystawki</option>
        <option value="zupy"' . selected("zupy", $danie) . '>Zupy</option>
        <option value="dania"' . selected("dania", $danie) . '>Dania</option>
        </select><br><br>
        <label><p class="sectionTextBold">Nazwa:</p></label><br>
        <input type="text" name="nazwa" id="formnazwa" value="' . $danie["nazwa"] . '"><br><br>
        <label><p class="sectionTextBold">Skład: </p></label><br>
        <textarea rows="5" cols="50" name="sklad", id="formsklad">' . $danie["sklad"] . '</textarea><br><br>
        <label><p class="sectionTextBold">Cena: </p></label><br>
        <input type="text" name="cena" id="forcena" value="' . $danie["cena"] . '"><br><br>
        <label><p class="sectionTextBold">Dostępny: </p></label><br>
        <input type="radio" name="dostepnosc" value="1" ' . dostepny(1, $danie) . '> Tak<br>
        <input type="radio" name="dostepnosc" value="0" ' . dostepny(0, $danie) . '> Nie<br>
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
    } else if ($_POST["action"] == 2) {
        echo '
    <form id="form" action="adminmenu.php" method="post">
    <input type="hidden" value="' . $_POST["action"] . '" name="action" id="formaction">
    <input type="hidden" value="' . $_POST["id"] . '" name="id" id="formid">
    </form>

    <div class="section group">

    <div class="col span_12_of_12">
    </div>

    </div>

    <div class="section group">

        <div class="col span_12_of_12">
            <p class="sectionTextBold"> Czy na pewno chcesz usunąć pozycję w menu? </p>
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