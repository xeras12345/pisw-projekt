<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <link rel="stylesheet" href="rezerwacje.css" type="text/css">
  <script src="script.js"></script>
  <script src="rezerwacje.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<body>

<?php
include("header.php");
require_once "connect.php";

if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM bookings WHERE DATE(bdate) BETWEEN DATE(CURRENT_DATE()) AND DATE(CURRENT_DATE() + INTERVAL 7 DAY)";
$result = mysqli_query($link, $sql);
echo "<script>var bookings = []</script>";
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      //echo "name: " . $row["name"]. " - tableid: " . $row["tableid"]." - date: " . $row["bdate"]. "- time: " . $row["btime"]."<br>";
      $bdate = substr(strval($row["bdate"]),-2);
      $btime = strval($row["btime"]);
      $tableid = strval($row["tableid"]);
      //echo $bdate;
      echo '<script>bookings.push("'.$bdate.','.$btime.','.$tableid.'")</script>';
  }
} else {
  echo "0 results";
}
?>

<section>
<script>//alert(bookings)</script>
<script>//alert(getBookedTablesId(bookings, "28", "18:00"))</script>
<div class="section group">
  <div class="col span_6_of_12">
    <p class="sectionTextBold">Wybierz dzień:</p>
    <div id="dateblocks">
      <div class="dateblock" id="date1" onclick="showBookedTables(bookings, 1)">
      </div>
      <div class="dateblock" id="date2" onclick="showBookedTables(bookings, 2)">
      </div>
      <div class="dateblock" id="date3" onclick="showBookedTables(bookings, 3)">
      </div>
      <div class="dateblock" id="date4" onclick="showBookedTables(bookings, 4)">
      </div>
      <div class="dateblock" id="date5" onclick="showBookedTables(bookings, 5)">
      </div>
      <div class="dateblock" id="date6" onclick="showBookedTables(bookings, 6)">
      </div>
      <div class="dateblock" id="date7" onclick="showBookedTables(bookings, 7)">
      </div>
    </div>
    <script>fillDateBlocks()</script>
  </div>
  <div class="col span_6_of_12">
    <p class="sectionTextBold">Wybierz godzinę:</p>
    <div id="timeblocks">
      <div class="timeblock">
        <img src="img/remove.png" class="timeIcon" id="timeIcon1" onclick="timeDown(bookings, 1)">
      </div>
      <div class="timeblock">
        <p class="timeText" id="timeblock"></p>
      </div>
      <div class="timeblock">
        <img src="img/add.png" class="timeIcon" id="timeIcon2" onclick="timeUp(bookings, 1)">
      </div>
    </div>
    <script>fillTimeBlock()</script> 
  </div>
</div>

</section>

<section id="plan">

<div class="section group">
    <div class="col span_12_of_12">
        <img src="img/stolikmaly0.png" class="responsiveImageTableSmall" id="table1">
        <img src="img/stolikmaly0.png" class="responsiveImageTableSmall" id="table2">
        <img src="img/stolikmaly0.png" class="responsiveImageTableSmall" id="table3">
        <img src="img/stolikmaly0.png" class="responsiveImageTableSmall" id="table4">
        <img src="img/stolikduzy0.png" class="responsiveImageTableBig" id="table5">
        <img src="img/stolikmaly0.png" class="responsiveImageTableSmall" id="table6">
        <img src="img/stolikduzy0.png" class="responsiveImageTableBig" id="table7">
    </div>
</div>

</section>

<script>showBookedTables(bookings, 1)</script>

<?php
include("footer.php");
mysqli_close($link);
?>

</body>
</html>