<?php
session_start();
$url = "/www/src";

if (isset($_SESSION['user_id'])) {
    header("Location: $url");
    exit;
}

?>

<!DOCTYPE html>
<html lang="lt-LT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form-styles.css" type="text/css">
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Prisijungimas</title>
</head>

<body>
    <div class="form-box">
        <h1 class="form-heading">Prisijungkite</h1>
        
         <img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"><a class="smaller-img-top-left" href="../src"></a>
        
        <form action="actions/login.php" method="post">
            <label for="email" class="form-label">El.paštas:</label>
            <p></p>
            <input type="email" name="email" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_email'] ?? "") ?>" maxlength="80" placeholder="Įveskite el paštą.">
            <?php
            if (isset($_GET["email"])) {
                echo "<span class = 'error'>*Įveskite el. paštą.</span>";
            }
    
            if (isset($_GET["user"])) {
                echo "<span class ='error'>*Neteisingas el. paštas.</span>";
            }  
            
            ?>
            <p></p>
            <label for="password" class="form-label">Slaptažodis:</label>
            <p></p>
            <input type="password" name="password" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_password'] ?? "") ?>" maxlength="80" placeholder="Įveskite slaptažodį.">
            <?php
            if (isset($_GET["password"])) {
                echo "<span class = 'error'>*Įveskite slaptažodį.</span>";
            }
            if (isset($_GET["mismatch"])) {
                echo "<span class = 'error'>*Neteisingas slaptažodis.</span>";
            }    
            ?>
            <p></p>
            <input type="submit" class="form-submit" value="Prisijungti">
            <p class="form-paragraph">Nesate užsiregistravę? Susikurkite paskyrą <a href="register-page.php" class="form-link">čia</a>.</p>

        </form>
    </div>
</body>
<footer>
    © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
</footer>

</html>