
<div class="section group">

<div class="col span_2_of_12">
</div>
<div class="col span_4_of_12">
<p class="sectionTitle">TWOJA REZERWACJA:</p>
<p class="sectionTextBold">Numer stolika: <?php echo $_POST["tableid"]; ?></p>
<p class="sectionTextBold">Dzień rezerwacji: <?php echo $_POST["day"]; ?></p>
<p class="sectionTextBold">Godzina: <?php echo $_POST["time"]; ?></p>
</div>
<div class="col span_3_of_12">
<?php
if(isset($_SESSION["loggedin"])){
    echo '<p class="sectionTitle">TWOJE DANE:</p>';
    echo '
    <form id="form" action="potwierdzrezerwacje.php" method="post">
    <label><p class="sectionTextBold">Imie i nazwisko: </p></label>
    <input type="text" name="name" id="name" required><br>
    <label><p class="sectionTextBold">Numer telefonu: </p></label>
    <input type="tel" pattern="[0-9]{9}" name="tel" id="tel" required><br>
    <label><p class="sectionTextBold">Email: </p></label>
    <input type="email" name="email" id="email" value='.$_SESSION["email1"].'>
    <input type="hidden" name="tableid" id="formtableid">
    <input type="hidden" name="day" id="formday">
    <input type="hidden" name="time" id="formtime">
    <p class="textMenu">Zaloguj się, aby później zarządzać rezerwacją.</p>
    </form>';
} else {
    echo '<p class="sectionTitle">TWOJE DANE:</p>';
    echo '
    <form id="form" action="potwierdzrezerwacje.php" method="post">
    <label><p class="sectionTextBold">Imie i nazwisko: </p></label>
    <input type="text" name="name" id="name" required><br>
    <label><p class="sectionTextBold">Numer telefonu: </p></label>
    <input type="tel" pattern="[0-9]{9}" name="tel" id="tel" required><br>
    <label><p class="sectionTextBold">Email: </p></label>
    <input type="email" name="email" id="email">
    <input type="hidden" name="tableid" id="formtableid">
    <input type="hidden" name="day" id="formday">
    <input type="hidden" name="time" id="formtime">
    <p class="textMenu">Zaloguj się, aby później zarządzać rezerwacją.</p>
    </form>';
}
?>
</div>
<div class="col span_3_of_12">
</div>

</div>

<div class="section group">

<div class="col span_4_of_12">
</div>

<div class="col span_2_of_12">
</div>

<div class="col span_2_of_12">
<button onclick=goBack()> Anuluj </button>
<?php
echo '<button onclick="formSubmit('.$_POST["tableid"].','.substr($_POST["day"],0,2).','.substr($_POST["day"],3,2).',
'.substr($_POST["time"],0,2).','.substr($_POST["time"],3,2).')">
Zatwierdź
</button>'
?>

</div>

<div class="col span_4_of_12">
</div>
</div>
