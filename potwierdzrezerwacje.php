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
  <script src="potwierdzrezerwacje.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php include("header.php");
$link->query('SET NAMES utf8');
$link->query('SET CHARACTER_SET utf8_unicode_ci'); ?>


<?php
    if (isset($_POST["name"])) {

        require_once "connect.php";

        // Check connection
        if (mysqli_connect_errno())
        {
        echo "Nie można połączyć z bazą danych: " . mysqli_connect_error(). "<br> Spróbuj ponownie później.";
        }

        $sql="INSERT INTO bookings (bdate, btime, tableid, bname, phone, email)
        VALUES
        ('$_POST[day]','$_POST[time]','$_POST[tableid]','$_POST[name]','$_POST[tel]','$_POST[email]')";

        if (!mysqli_query($link,$sql))
        {
        die('Wystąpił błąd: ' . mysqli_error($link).'<br> Spróbuj ponownie później.');
        }
        echo '
        <p class="sectionTitle">Twoja rezerwacja została pomyślnie zapisana!</p>
        <p class="textMenu">Za chwilę przekierujemy Cię na stronę główną.</p>
        <script>waitThenHome()</script>
        ';
        $_POST = array();

        mysqli_close($link);

    } else if (isset($_POST["tableid"])) {
        include("potwrezcontent.php");
    } else {
        echo '<script>goBack()</script>';
    }
?>

<?php include("footer.php"); ?>

</body>
</html>