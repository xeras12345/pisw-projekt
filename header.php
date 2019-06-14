
<header>

<nav>
    <div class="section group">
        <div class="col span_2_of_12">
            <a href="https://www.facebook.com" target="_blank"><img src="img/social (3).png" class="responsiveImageSocial"></a>
            <a href="https://www.twitter.com" target="_blank"><img src="img/social (1).png" class="responsiveImageSocial"></a>
            <a href="https://www.instagram.com" target="_blank"><img src="img/social (2).png" class="responsiveImageSocial"></a>
        </div>
        <div class="col span_1_of_12">
        </div>
        <div class="col span_9_of_12">
            <ul id="menulist">
                <li><a href="home.php">STRONA GŁÓWNA</a></li>
                <li onclick="usun();"><a href="zamow_online_bez_logowania.php">ZAMÓW ONLINE</a></li>
                <li><a href="rezerwacje.php">REZERWACJE</a></li>
                <li><a><span id="log" onclick="document.getElementById('modal-wrapper').style.display='block'">LOGOWANIE</span></a></li>
            </ul>
        </div>
    </div> 
    <?php 
if(!empty($_SESSION["cart"])){
                $outall = '';
                foreach ($_SESSION["cart"] as $key => $value) {
                  echo'<a href="zamowonline.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span id="click"></span></a>';
                }
              }

?>

</nav>

<div class="section group">

    <div class="col span_4_of_12">
    </div>
    <div class="col span_4_of_12">
        <img src="img/logo1.png" class="responsiveImageHeader" id="logo">
    </div>
    <div class="col span_4_of_12">

</div>

</header>

<script src="logoscript.js"></script>

<?php
// Initialize the session
session_start();

// Include config file
require_once "connect.php";

// Define variables and initialize with empty values
$email1 = $password1 = "";
$email1_err = $password1_err = "";
$password2_err = "";

// Processing form data when form is submitted

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction'])){

// Check if username is empty
if(empty(trim($_POST["email1"]))){
    $email1_err = "<p><font size='2' color='red'>Proszę wprowadzić adres email</font></p>";
} else{
    $email1 = trim($_POST["email1"]);
}

// Check if password is empty
if(empty(trim($_POST["password1"]))){
    $password1_err = "<p><font size='2' color='red'>Proszę wprowadzić hasło</font></p>";
} else{
    $password1 = trim($_POST["password1"]);
}

// Validate credentials
if(empty($email1_err) && empty($password1_err)){
    // Prepare a select statement
    $sql = "SELECT id, email, haslo FROM users WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email1);
        
        // Set parameters
        $param_email1 = $email1;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $id, $email1, $hashed_password1);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password1, $hashed_password1)){
                        // Password is correct, so start a new session
                        //session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email1"] = $email1;                            
                        
                        // Redirect user to welcome page
                        
                        header('home.php');
                    } else{
                        // Display an error message if password is not valid
                        $password1_err = "<p><font size='2' color='red'>Hasło które podałeś jest błędne</font></p>";
                        ?>
                        <div id="modal-wrapper5" class="modal5">

                          <form class="modal5-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
                            <div class="imgcontainer">
                              <span onclick="document.getElementById('modal-wrapper5').style.display='none'" class="close" title="Close PopUp">&times;</span>
                              <h2 style="text-align:center">Logowanie</h2></br>
                        </div>

                           <div class="container3">
                        <div class="textbox <?php echo (!empty($email1_err)) ? 'has-error' : ''; ?>">
                        <input type="text" name="email1" placeholder="Email" required="required">
                        </div>
                        <?php echo $email1_err; ?>
                        <div class="textbox <?php echo (!empty($password1_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password1" class="form-control" placeholder="Hasło" required="required">
                        </div>
                        <?php echo $password1_err; ?></br>
        
         

                        <div>
                            <input type="submit" name="someAction" class="btn" value="Zaloguj się" >
                        </div>

                    </form>
                          <div><span>Nie masz jeszcze konta?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper5').style.display='none';document.getElementById('modal-wrapper2').style.display='block'" > Zarejestruj się </span>
                    </div>


                </div>

        
            </div>
            <?php


                
                    }
                }
            } else{
                // Display an error message if username doesn't exist
                $email1_err = "<p><font size='2' color='red'>Nie mamy takiego użytkownika w bazie</font></p>";
                ?>
                        <div id="modal-wrapper5" class="modal5">

                          <form class="modal5-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
                            <div class="imgcontainer">
                              <span onclick="document.getElementById('modal-wrapper5').style.display='none'" class="close" title="Close PopUp">&times;</span>
                              <h2 style="text-align:center">Logowanie</h2></br>
                        </div>

                           <div class="container3">
                        <div class="textbox <?php echo (!empty($email1_err)) ? 'has-error' : ''; ?>">
                        <input type="text" name="email1" placeholder="Email" required="required">
                        </div>
                        <?php echo $email1_err; ?>
                        <div class="textbox <?php echo (!empty($password1_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password1" class="form-control" placeholder="Hasło" required="required">
                        </div>
                        <?php echo $password1_err; ?></br>
        
         

                        <div>
                            <input type="submit" name="someAction" class="btn" value="Zaloguj się" >
                        </div>

                    </form>
                          <div><span>Nie masz jeszcze konta?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper5').style.display='none';document.getElementById('modal-wrapper2').style.display='block'" > Zarejestruj się </span>
                    </div>


                </div>

        
            </div>
            <?php
            }
            
        } else{
            echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Coś nie tak z sql squery: " . mysqli_error($link);
    }
    
    // Close statement
    
}

// Close connection
mysqli_close($link);
}
?>


<?php
// Include config file
require_once "connect.php";

// Define variables and initialize with empty values
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['newAction'])){

// Validate username
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_err = "<p><font size='2' color='red'>Proszę wprowadzić poprawny email</font></p>";
    ?>
<div id="modal-wrapper7" class="modal7">
<form class="modal7-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
<div class="imgcontainer">
  <span onclick="document.getElementById('modal-wrapper7').style.display='none'" class="close" title="Close PopUp">&times;</span>
  <h2 style="text-align:center">Rejestracja</h2></br>
</div>

<div class="container3">
        <div class="textbox">
            <input type="text" name="email" placeholder="Email" required="required">
        </div>
        <?php echo $email_err; ?>

        <div class="textbox">
            <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
        </div>
        <?php echo $password_err; ?>
    
        <div class="textbox">
            <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required">
        </div></br>
        <?php echo $confirm_password_err; ?>
         

        <div>
            <input type="submit" class="btn" value="Zarejestruj się" name="newAction">
        </div>
        <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>

</form>
</div>

</div>
                <?php
    
} else{
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        
        // Set parameters
        $param_email = trim($_POST["email"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "<p><font size='2' color='red'>Ten email jest już zajęty</font></p>";
        
                ?>
<div id="modal-wrapper7" class="modal7">
<form class="modal7-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
<div class="imgcontainer">
  <span onclick="document.getElementById('modal-wrapper7').style.display='none'" class="close" title="Close PopUp">&times;</span>
  <h2 style="text-align:center">Rejestracja</h2></br>
</div>

<div class="container3">
        <div class="textbox">
            <input type="text" name="email" placeholder="Email" required="required">
        </div>
        <?php echo $email_err; ?>

        <div class="textbox">
            <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
        </div>
        <?php echo $password_err; ?>
    
        <div class="textbox">
            <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required">
        </div></br>
        <?php echo $confirm_password_err; ?>
         

        <div>
            <input type="submit" class="btn" value="Zarejestruj się" name="newAction">
        </div>
        <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>

</form>
</div>

</div>
                <?php
            } else{
                $email = trim($_POST["email"]);
            }
        } else{
            echo "<p><font size='2' color='red'>Ups! Coś poszło nie tak, spróbuj ponownie później</font></p>";
            ?>
            <div id="modal-wrapper7" class="modal7">
            <form class="modal7-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                <div class="imgcontainer">
                  <span onclick="document.getElementById('modal-wrapper7').style.display='none'" class="close" title="Close PopUp">&times;</span>
                  <h2 style="text-align:center">Rejestracja</h2></br>
                </div>
            
                <div class="container3">
                        <div class="textbox">
                            <input type="text" name="email" placeholder="Email" required="required">
                        </div>
                        <?php echo $email_err; ?>
             
                        <div class="textbox">
                            <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
                        </div>
                        <?php echo $password_err; ?>
                    
                        <div class="textbox">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required">
                        </div></br>
                        <?php echo $confirm_password_err; ?>
                         
            
                        <div>
                            <input type="submit" class="btn" value="Zarejestruj się" name="newAction">
                        </div>
                        <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>
                
              </form>
            </div>
              
            </div>
                                <?php
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

// Validate password
if(empty(trim($password))){
    $password_err = "<p><font size='2' color='red'>Proszę wprowadzić hasło</font></p>";     
} elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "<p><font size='2' color='red'>Hasło musi mieć minimum 6 znaków</font></p>";
    ?>
    <div id="modal-wrapper7" class="modal7">
    <form class="modal7-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
        <div class="imgcontainer">
          <span onclick="document.getElementById('modal-wrapper7').style.display='none'" class="close" title="Close PopUp">&times;</span>
          <h2 style="text-align:center">Rejestracja</h2></br>
        </div>
    
        <div class="container3">
                <div class="textbox">
                    <input type="text" name="email" placeholder="Email" required="required">
                </div>
                <?php echo $email_err; ?>
     
                <div class="textbox">
                    <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
                </div>
                <?php echo $password_err; ?>
            
                <div class="textbox">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required">
                </div></br>
                <?php echo $confirm_password_err; ?>
                 
    
                <div>
                    <input type="submit" class="btn" value="Zarejestruj się" name="newAction">
                </div>
                <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>
        
      </form>
    </div>
      
    </div>
                        <?php
} else{
    $password = trim($_POST["password"]);
}

// Validate confirm password
if(empty(trim($confirm_password))){
    $confirm_password_err = "<p><font size='2' color='red'>Proszę powtórzyć hasło</font></p>";     
} else{
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
        
        $confirm_password_err = "<p><font size='2' color='red'>Podane hasła nie pasują do siebie</font></p>";
        ?>
        <div id="modal-wrapper7" class="modal7">
        <form class="modal7-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
            <div class="imgcontainer">
              <span onclick="document.getElementById('modal-wrapper7').style.display='none'" class="close" title="Close PopUp">&times;</span>
              <h2 style="text-align:center">Rejestracja</h2></br>
            </div>
        
            <div class="container3">
                    <div class="textbox">
                        <input type="text" name="email" placeholder="Email" required="required">
                    </div>
                    <?php echo $email_err; ?>
         
                    <div class="textbox">
                        <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
                    </div>
                    <?php echo $password_err; ?>
                
                    <div class="textbox">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required">
                    </div></br>
                    <?php echo $confirm_password_err; ?>
                     
        
                    <div>
                        <input type="submit" class="btn" value="Zarejestruj się" name="newAction">
                    </div>
                    <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>
            
          </form>
        </div>
          
        </div>
                            <?php
        
    }
    
}

// Check input errors before inserting in database
if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
    
    // Prepare an insert statement
    $sql = "INSERT INTO users (email, haslo) VALUES (?, ?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
        
        // Set parameters
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            $to_email = $_POST['email'] ;
            $subject = 'Potwierdzenie Rejestracji - Założyłeś nowe konto na stronie LOIGNON.PL';
            $message = 'Dziękujemy za rejestracje i zapraszamy do korzystania z naszej cudownej strony!';
            $headers = 'Od: Loignon';
            $headers .= 'Content-Type: text/html; charset=utf-8';
            mail($to_email,$subject,$message,$headers);
            ?>
            <div id="modal-wrapper5" class="modal5">

              <form class="modal5-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="imgcontainer">
                  <span onclick="document.getElementById('modal-wrapper5').style.display='none'" class="close" title="Close PopUp">&times;</span>
                  <h2 style="text-align:center">Logowanie</h2></br>
                  <span style="text-align:center">Rejestracja przebiegła pomyślnie!</span></br>
            </div>

               <div class="container3">
            <div class="textbox <?php echo (!empty($email1_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="email1" placeholder="Email" required="required">
            </div>
            <?php echo $email1_err; ?>
            <div class="textbox <?php echo (!empty($password1_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password1" class="form-control" placeholder="Hasło" required="required">
            </div>
            <?php echo $password1_err; ?></br>



            <div>
                <input type="submit" name="someAction" class="btn" value="Zaloguj się" >
            </div>

        </form>
              <div><span>Nie masz jeszcze konta?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper5').style.display='none';document.getElementById('modal-wrapper2').style.display='block'" > Zarejestruj się </span>
        </div>


    </div>


</div>
<?php

            
            
    

        } else{
            echo "Coś poszło nie tak, spróbuj ponownie później.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($link);
}

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo("<script> changemenu(); </script>");
}
?>
<section>
<div id="modal-wrapper" class="modal">

<form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
<div class="imgcontainer">
  <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
  <h1 style="text-align:center">Logowanie</h1></br>
</div>

<div class="container3">
        <div class="textbox <?php echo (!empty($email1_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="email1" placeholder="Email" required="required">
        </div>
        
        <div class="textbox <?php echo (!empty($password1_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password1" class="form-control" placeholder="Hasło" required="required">
        </div>
       
        
         

        <div>
            <input type="submit" name="someAction" class="btn" value="Zaloguj się" >
        </div>

</form>
<div><span>Nie masz jeszcze konta?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper').style.display='none';document.getElementById('modal-wrapper2').style.display='block'" > Zarejestruj się </span>
</div>


</div>

</div>

<div id="modal-wrapper2" class="modal2">

<form class="modal-content2 animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
<div class="imgcontainer">
  <span onclick="document.getElementById('modal-wrapper2').style.display='none'" class="close" title="Close PopUp">&times;</span>
  <h1 style="text-align:center">Rejestracja</h1></br>
</div>

<div class="container3">
        <div class="textbox">
            <input type="text" name="email" placeholder="Email" required="required">
        </div>
        

        <div class="textbox">
            <input type="password" name="password" class="form-control" placeholder="Hasło" required="required">
        </div>
        
    
        <div class="textbox">
            <input type="password" name="confirm_password" class="form-control" placeholder="Powtórz Hasło" required="required" >
        </div></br>
        
         

        <div>
            <input type="submit" class="btn" value="Zarejestruj się" name="newAction" >
        </div>
        <div><span>Masz już konto?</span><span style="color:darkolivegreen;font-weight:bold" onclick="document.getElementById('modal-wrapper2').style.display='none';document.getElementById('modal-wrapper').style.display='block'" > Zaloguj się</span>

</form>
</div>


</div>

</section>
