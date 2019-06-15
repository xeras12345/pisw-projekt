<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=2)">
  <title>Koszyk</title>
  <meta name="description" content="Restaurant home page">
  <meta name="author" content="">
  <link rel="stylesheet" type="text/css" href="styles.css?version=51">
  <script src="script.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">

 
</head>
 
<body>
 
 
<?php include("header.php"); ?>


<div class="section"> 
 
    <section id="kontejner_koszyk">
        
        <div class="section group">
            
                <p class="sectionTitle">Koszyk:<p>
                <p class="sectionTitle"> Twoje produkty</p>
                <div class="col span_1_of_12"></div>
                <div class="col span_3_of_12"><p class="sectionTextBold textMenu">Nazwa produktu</p></div>
                <div class="col span_2_of_12"><p class="sectionTextBold textMenu">Ilość</p></div>
                <div class="col span_3_of_12"><p class="sectionTextBold textMenu">Cena za produkt</p></div>
                <div class="col span_3_of_12"><p class="sectionTextBold textMenu">Cena za produkty</p></div>

        </div>
            
            

            <div class="section group">        
            <?php           
                $total = 0;
            
                if(!empty($_SESSION["cart"])){
                    $outall = '';
                    foreach ($_SESSION["cart"] as $key => $value) {
                        
                        ?>
                        
                        <?php $produkty = $value["item_name"];?>

                        <div class="col span_1_of_12"></div>
                        <div class="col span_2_of_12"><p class="textMenu"><?php echo $value["item_name"];
                            $outall = ''.$outall.$value["item_name"].'/';?></p></div>
                        <div class="col span_1_of_12"></div>     
                        <div class="col span_2_of_12"><p class="textMenu"><?php echo $value["item_quantity"]; ?></p></div>
        
                        <div class="col span_2_of_12"><p class="textMenu"><?php echo $value["product_price"]; ?> zł</p></div>
                        <div class="col span_1_of_12"></div>
                        <div class="col span_2_of_12"><p class="textMenu"><?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?> zł</p></div>
                        <div class="col span_1_of_12"></div>

                            <a href="zamowonline.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span id="click"></span></a>
                        
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        
                        
                    }
                    
                        ?>
                        
            
                    
                    
                        
                        
                            
                        
                        <?php
                        $kwota = $total;
                        
                        
                    }
                ?>

            
            </div>
            <div class="section group">
            <p class="sectionTitle">Suma:<?php echo number_format($total, 2); ?> zł </p>
            </div>

        </div>
        
    </section>
    <section>
    <?php 
        if(isset($_SESSION["loggedin"])){

            echo'<form id="myForm" action="koszyk.php" method="post">
            <div class="section group">

                <p class="sectionTitle">Twoje Dane:<p>
                
                <div id="dane_osobowe" class="col span_6_of_12">
                    <p class="sectionTitle">Dane Osobowe:<p>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-user"></i></div>
                        <div class="input_koszyk"><input type="text" placeholder="Wpisz Imię i Nazwisko" /></div>
                        </div>
                    </div>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-envelope"></i></div>
                        <div class="input_koszyk"><input type="email" name="email" value='.$_SESSION["email1"].' readonly/></div>
                        </div>
                    </div>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-phone-alt"></i></div>
                        <div class="input_koszyk"><input type="text" name="numer" placeholder="Numer telefonu" /></div>
                        </div>
                    </div>

                    <div class="section group">
                        <div class="col span_12_of_12">
                        <fieldset>

                            <legend> Rodzaj dostawy </legend>
                            
                            <div><label><input type="radio" value="1" name="dostawa" id="osobisty" required onclick="sprawdzenie();"> Odbiór osobisty</label></div>
                            <div><label><input type="radio" value="2" name="dostawa" id="dom" required onclick="sprawdzenie();"> Do domu</label></div>
                        </div>
                    </div>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <fieldset>

                            <legend> Metoda płatności </legend>
                            
                            <div><label><input type="radio" value="1" name="platnosc" checked disabled> Przy odbiorze</label></div>
                        
                        </div>
                    </div>


                    
                </div>

                <div id="dane_adresowe" class="col span_6_of_12">
                    <p class="sectionTitle">Dane Adresowe:<p>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-address-card"></i></div>
                        <div class="input_koszyk"><input type="text" name="adres" id="adres" placeholder="Ulica i numer lokalu" /></div>
                        </div>
                    </div>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-city"></i></div>
                        <div class="input_koszyk"><input type="text" name="miasto" id="miasto" placeholder="Wpisz miasto" /></div>
                        </div>
                    </div>
                    
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <div class="ikonka"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="input_koszyk"><input type="text" name="miasto" id="kod" placeholder="Kod pocztowy(XX-XXX)" /></div>
                        </div>
                    </div>
                    <div class="section group">
                        <div class="col span_12_of_12">
                        <label>Uwagi do zamówienia</label></br>
                        <textarea name="uwagi" id="komentarz" rows="8" cols="80" placeholder="Jeśli masz jakieś uwagi, opisz je tutaj..."></textarea>
                        </div>
                    </div>

            
                </div>
     


            </div>'
                
                ?>    
    </section>
                <section>
             
                <div class="section group">
                    <div id="przycisk_zamow" onclick="document.getElementById('okno_potwierdzajace').style.display='block'"><p class="sectionTextBold textMenu">Złóż zamówienie</p></div>
                    <div id="okno_potwierdzajace" class="okno">
                        <div class="okno-content animate">
                        <div class="section group">
                        <div class="col span_12_of_12">
                        <p class="sectionTextBold textMenu" style="text-align:center;">Czy na pewno chcesz złożyć zamówienie?</p>
                        <div>
                            <input id="submitform" name="submitform" type="submit"  class="btn" value="Tak" onclick="usun();">
                            <input type="button"  class="btn" value="Nie" onclick="document.getElementById('okno_potwierdzajace').style.display='none'">
                        </div>
        </div>
                        </div>
        </div>
                    </div>
                </div>
                </form>

                <?php
            
                } 
                ?>
                



    </div>
    </section>  

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
</div>
    

  <script>
   function usun()
   {
    document.getElementById('click').click();
   }
 </script>

<script>
    function sprawdzenie()
    {
       
        if(document.getElementById("osobisty").checked) {
            nasz_adres();
        }else if(document.getElementById("dom").checked) {
            adres_uzytkownika();
        }
    }
                           

   function nasz_adres()
   {
       document.getElementById("adres").value='Kuźnicza 15';
       document.getElementById("adres").disabled = true;
       document.getElementById("miasto").value='Wrocław';
       document.getElementById("miasto").disabled = true;
       document.getElementById("kod").value='53-635';
       document.getElementById("kod").disabled = true;
   }
   function adres_uzytkownika()
   {
       document.getElementById("adres").value='';
       document.getElementById("adres").disabled = false;
       document.getElementById("miasto").value='';
       document.getElementById("miasto").disabled = false;
       document.getElementById("kod").value='';
       document.getElementById("kod").disabled = false;
   }

 

 
 </script>


    





 
<?php include("footer.php"); ?>
 
</body>
</html>