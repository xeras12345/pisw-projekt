<?php
require_once "connect.php";
function czyAdmin($link) {
    $sql = 'SELECT id, email, isadmin FROM users WHERE email = ?';
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['email1']);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);  
            } else {
                echo "Ups! Coś poszło nie tak, spróbuj ponownie później";
            }
        } else {
            echo "Coś nie tak z sql squery: " . mysqli_error($link);
        }
        mysqli_stmt_bind_result($stmt, $id, $email, $isadmin1);
        while (mysqli_stmt_fetch($stmt)) {
            $isadmin = $isadmin1;
        }
        mysqli_stmt_close($stmt);
        return $isadmin;
    }

if (czyAdmin($link) !== 1) {
echo '<script>window.location = "home.php"</script>';
    }
?>