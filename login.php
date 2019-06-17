<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Logowanie</title>
    <meta name="description" content="Restaurant Login Page">
    <meta name="author" content="">

    <link rel="stylesheet" href="styles2.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

</head>



<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home_logged.php");
    exit;
}

// Include config file
require_once "connect.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "<p><font size='2' color='red'>Proszę wprowadzić adres email</font></p>";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "<p><font size='2' color='red'>Proszę wprowadzić hasło</font></p>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, haslo FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            header("location: home_logged.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "<p><font size='2' color='red'>Hasło które podałeś jest błędne</font></p>";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $email_err = "<p><font size='2' color='red'>Nie mamy takiego użytkownika w bazie</font></p>";
                }
            } else {
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





<body>
    <div class="container">

        <h1> Logowanie </h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="textbox <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
            </div>
            <?php echo $email_err; ?>
            <div class="textbox <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control" placeholder="Hasło">

            </div>
            <?php echo $password_err; ?>
            <div>
                <input type="submit" class="btn" value="Zaloguj się">
            </div>
            <p>Nie masz jeszcze konta? <a href="register.php">Zarejestruj się</a>.</p>
        </form>




    </div>
</body>

</html>