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
    include("wymaganyadmin.php");
    ?>

    <section>

        <div class="section group">
            <div class="col span_12_of_12">
                <p class="sectionTitle">Witaj w panelu administratora!</p>
            </div>
        </div>

        <div class="section group">
            <ul id="adminnav">
                <div class="col span_4_of_12">
                    <li><a href="adminmenu.php">ZARZĄDZAJ SWOIM MENU</a></li>
                </div>
                <div class="col span_4_of_12">
                    <li><a href="adminzamowienia.php">ZARZĄDZAJ ZAMÓWIENIAMI</a></li>
                </div>
                <div class="col span_4_of_12">
                    <li><a href="adminrezerwacje.php">ZARZĄDZAJ REZERWACJAMI</a></li>
                </div>
            </ul>
        </div>

    </section>

    <?php
    include("footer.php");
    mysqli_close($link);
    ?>

</body>

</html>