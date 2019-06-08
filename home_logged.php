<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Restaurant</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">

  <link rel="stylesheet" href="styles.css" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<body>

<header>

	<nav>
		<div class="section group">
			<div class="col span_2_of_12">
				<img src="img/social (3).png" class="responsiveImageSocial">
				<img src="img/social (1).png" class="responsiveImageSocial">
				<img src="img/social (2).png" class="responsiveImageSocial">
			</div>
			<div class="col span_5_of_12">
			</div>
			<div class="col span_5_of_12">
				<ul>
					<li>STRONA GŁÓWNA</li>
					<li>ZAMÓW ONLINE</li>
					<li>REZERWACJE</li>
					<li><a href="logout.php">WYLOGUJ</a></li>
				</ul>
			</div>
		</div>

	</nav>
	<div class="section group">

		<div class="col span_4_of_12">
		</div>
		<div class="col span_4_of_12" class="ressponsiveImageHeaderParent" id="logo">
            <img src="img/logo1.png" class="responsiveImageHeader1" id="logo1">
            <img src="img/logo2.png" class="responsiveImageHeaderHidden responsiveImageHeader2" id="logo2">
		</div>
		<div class="col span_4_of_12">

	</div>

</header>


<section>
<div>
        <h1>Witaj, <b><?php echo htmlspecialchars($_SESSION["email1"]); ?></b>. Witamy na naszej stronie.</h1>
    </div>
</section>

<section id="about">

	<div class="section group">

		<div class="col span_12_of_12">
			<p class="sectionTitle">NASZE MIEJSCE</p>
		</div>

	</div>

	<div class="section group">

		<div class="col span_2_of_12">
		</div>
		<div class="col span_2_of_12">
			<p class="sectionTextBold">TELEFON</p>
			<p class="sectionTextBold">ADRES</p>
		</div>
		<div class="col span_2_of_12">
			<p class="sectionText">500-500-500</p>
			<p class="sectionText">ul. Kuźnicza 15</p>
			<p class="sectionText">76-628 Wrocław</p>
		</div>
		<div class="col span_4_of_12">
			<img src="img/mapa.png" class="responsiveImageMap">
		</div>
		<div class="col span_2_of_12">
		</div>

	</div>

</section>

<footer>
	stoooopka
</footer>

</body>
</html>