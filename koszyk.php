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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
 
</head>
 
<body>
 
 
<?php include("header.php"); ?>
 
 
 
 
<div id="kontener">

    <div id="kontener_koszyk">
        <h1>Koszyk:</h1>
    </div>

    <div id="dane">

        <h1>Twoje Dane:</h1>
        
        <div id="dane_osobowe">
            <h3>Dane Osobowe:</h3>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-user"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz Imię i Nazwisko"/></div>
            </div>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-envelope"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz email"/></div>
            </div>
            <div class="zestaw">
                <fieldset>

                    <legend> Rodzaj dostawy </legend>
                    
                    <div><label><input type="radio" value="1" name="dostawa" checked> Odbiór osobisty</label></div>
                    <div><label><input type="radio" value="2" name="dostawa" > Do domu</label></div>
                
            </div>
            <div class="zestaw">
                <fieldset>

                    <legend> Metoda płatności </legend>
                    
                    <div><label><input type="radio" value="1" name="platnosc" checked disabled> Przy odbiorze</label></div>
                  
                
            </div>


            
        </div>

        <div id="dane_adresowe">
            <h3>Dane Adresowe:</h3>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-address-card"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz adres zameldowania"/></div>
            </div>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-city"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz miasto"/></div>
            </div>
            
            <div class="kod">
                <p>Kod pocztowy:</p>
            
                <div class="input_kod"><input type="text" placeholder="np. 58-100"/></div>
            </div>
        

       


        </div>

    </div>

    <div style="clear:both;"></div>

    <div id="przycisk_zamow">Zamów</div>

    





</div>



 
<?php include("footer.php"); ?>
 
</body>
</html>