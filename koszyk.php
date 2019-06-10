<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Koszyk</title>
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
        

        <h2 style="text-align:center"> Twoje produkty</h2>
        <table>
                    <tr>
                        <th width="10%">Nazwa produktu</th>
                        <th width="10%">Ilość</th>
                        <th width="10%">Cena za produkt</th>
                        <th width="10%">Cena za produkty</th>
                    </tr>
        <?php           
            $total = 0;
            if(!empty($_SESSION["cart"])){
                
                foreach ($_SESSION["cart"] as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value["item_name"]; ?></td>
                        <td><?php echo $value["item_quantity"]; ?></td>
                        <td><?php echo $value["product_price"]; ?> zł</td>
                        <td><?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?> zł</td>
                    </tr>
                    <?php
                    $total = $total + ($value["item_quantity"] * $value["product_price"]);
                }
                    ?>
                    
                    
                    
                        
                    
                    <?php
                }
            ?>
        </table>
        <h3 style="text-align:center;">Suma:<?php echo number_format($total, 2); ?> zł </h3></br>
        
        


    </div>


    <form action="#">
    <div id="dane">

        <h1>Twoje Dane:</h1>
        
        <div id="dane_osobowe">
            <h3>Dane Osobowe:</h3>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-user"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz Imię i Nazwisko" required/></div>
            </div>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-envelope"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz email" required/></div>
            </div>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-phone-alt"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Numer telefonu" required/></div>
            </div>

            <div class="zestaw">
                <fieldset>

                    <legend> Rodzaj dostawy </legend>
                    
                    <div><label><input type="radio" value="1" name="dostawa" checked required> Odbiór osobisty</label></div>
                    <div><label><input type="radio" value="2" name="dostawa" required> Do domu</label></div>
                
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
                <div class="input_koszyk"><input type="text" placeholder="Wpisz adres zameldowania" required/></div>
            </div>
            <div class="zestaw">
                <div class="ikonka"><i class="fas fa-city"></i></div>
                <div class="input_koszyk"><input type="text" placeholder="Wpisz miasto" required/></div>
            </div>
            
            <div class="kod">
                <p>Kod pocztowy:</p>
                <div class="input_kod"><input type="text" placeholder="np. 58-100" required /></div>
            </div>
            

    
        </div>
        <div style="clear:both;"></div>

        <div class="uwagi">
            <label>Uwagi do zamówienia</label></br>
            <textarea name="komentarz" id="komentarz" rows="4" cols="80" placeholder="Jeśli masz jakieś uwagi, opisz je tutaj..."></textarea>
        </div>
        


    </div>
    
    

    <div style="clear:both;"></div>

    <input type="submit" value="Zamów" id="przycisk_zamow"/>
    </form>
    

    





</div>



 
<?php include("footer.php"); ?>
 
</body>
</html>