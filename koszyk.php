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
                $outall = '';
                foreach ($_SESSION["cart"] as $key => $value) {
                    
                    ?>
                    
                    <?php $produkty = $value["item_name"];?>

                    <tr>
                        <td id="nazwa"><?php echo $value["item_name"]; 
                         $outall = ''.$outall.$value["item_name"].'/';?></td>
                        <td><?php echo $value["item_quantity"]; ?></td>
                        <td><?php echo $value["product_price"]; ?> zł</td>
                        <td><?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?> zł</td>
                        <a href="zamowonline.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span id="click"></span></a>
                        
                        
                           
                    </tr>
                    <?php
                    $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    
                    
                }
                
                    ?>
                    
           
                
                
                    
                    
                        
                    
                    <?php
                    $kwota = $total;
                    
                    
                }
            ?>
        </table>
        <h3 style="text-align:center;">Suma:<?php echo number_format($total, 2); ?> zł </h3></br>
            
        

    

    </div>

<?php 
    if(isset($_SESSION["loggedin"])){

        echo'<form id="myForm" action="koszyk.php" method="post">
        <div id="dane">

            <h1>Twoje Dane:</h1>
            
            <div id="dane_osobowe">
                <h3>Dane Osobowe:</h3>
                <div class="zestaw">
                    <div class="ikonka"><i class="fas fa-user"></i></div>
                    <div class="input_koszyk"><input type="text" placeholder="Wpisz Imię i Nazwisko" /></div>
                </div>
                <div class="zestaw">
                    <div class="ikonka"><i class="fas fa-envelope"></i></div>
                    <div class="input_koszyk"><input type="email" name="email" value='.$_SESSION["email1"].' readonly/></div>
                </div>
                <div class="zestaw">
                    <div class="ikonka"><i class="fas fa-phone-alt"></i></div>
                    <div class="input_koszyk"><input type="text" name="numer" placeholder="Numer telefonu" /></div>
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
                    <div class="input_koszyk"><input type="text" name="adres" placeholder="Wpisz adres dostawy" /></div>
                </div>
                <div class="zestaw">
                    <div class="ikonka"><i class="fas fa-city"></i></div>
                    <div class="input_koszyk"><input type="text" name="miasto" placeholder="Wpisz miasto" /></div>
                </div>
                
                <div class="kod">
                    <p>Kod pocztowy:</p>
                    <div class="input_kod"><input type="text" placeholder="np. 58-100" /></div>
                </div>
                

        
            </div>
            <div style="clear:both;"></div>

            <div class="uwagi">
                <label>Uwagi do zamówienia</label></br>
                <textarea name="uwagi" id="komentarz" rows="4" cols="80" placeholder="Jeśli masz jakieś uwagi, opisz je tutaj..."></textarea>
            </div>
            


        </div>
        
        

            <div style="clear:both;"></div>'
            ?>
            
            <div id="przycisk_zamow" onclick="document.getElementById('okno_potwierdzajace').style.display='block'">Złóż zamówienie</div>
            <div id="okno_potwierdzajace" class="okno">
                <div class="okno-content animate">
                <h4 style="text-align:center">Czy na pewno chcesz złożyć zamówienie?</h4></br>
                    <div>
                        <input id="submitform" name="submitform" type="submit"  class="btn" value="Tak" onclick="usun();">
                        <input type="button"  class="btn" value="Nie" onclick="document.getElementById('okno_potwierdzajace').style.display='none'">
                    </div>
            </div>
            </form>
        <?php

        
        } 
        ?>
    
  

        
    </div>

    </div>

        





</div>

<?php
    require_once "connect.php";
    $date = date('Y-m-d');
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $adres = isset($_POST['adres']) ? $_POST['adres'] : '';
    $miasto = isset($_POST['miasto']) ? $_POST['miasto'] : '';
    $numer = isset($_POST['numer']) ? $_POST['numer'] : '';
    $uwagi = isset($_POST['uwagi']) ? $_POST['uwagi'] : '';
    if (isset($_POST['submitform']))
     {   

        $link->query("SET NAMES 'utf8'");
        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        } 

        $sql = "INSERT INTO zamowienia (email, kwota, produkty, adres, miasto, numer, uwagi, status, datazamowienia)
        VALUES ('$email', $kwota, '$outall','$adres','$miasto','$numer','$uwagi',0,'$date')";

        if ($link->query($sql) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }


        $link->close();
        ?>
        <script>
            window.location = "podsumowanie.php";
        </script>

        <?php
     }


?>
  
    

  <script>
   function usun()
   {
    document.getElementById('click').click();
   }
 </script>

    





 
<?php include("footer.php"); ?>
 
</body>
</html>