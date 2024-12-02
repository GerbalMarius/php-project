<?php
session_start();
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
    <title>Registracija</title>
</head>

<body>
    <div class="form-box">
        <h1 class="form-heading">Susikurkite paskyrą</h1> <img src="images/home-icon.svg" alt="home" class="smaller-img-top-left"> <a class="smaller-img-top-left" href="../src"></a>
        <form action="actions/register.php" method="post">
            <label for="name" class="form-label">Vardas:</label>
            <input type="text" name="name" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_name'] ?? ""); ?>" maxlength="80"  lang="lt-LT">
            <?php
            if (isset($_GET["name"])) {
                echo "<span class = 'error'>*Vardas yra būtinas.</span>";
            }  
            ?>
            <p></p>
            <label for="last-name" class="form-label">Pavardė:</label>
            <input type="text" name="last-name" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_last_name'] ?? ""); ?>" maxlength="80">
            <?php
            if (isset($_GET["last_name"])) {
                echo "<span class = 'error'>*Pavardė yra būtina.</span>";
            }  
            ?>
            <p></p>
            <label for="email" class="form-label">El.paštas:</label>
            <input type="email" name="email" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_email'] ?? ""); ?>">
            <?php
            if (isset($_GET["email"])) {
                echo "<span class = 'error'>*El.paštas yra būtinas.</span>";
            }  
            ?>
            <p></p>
            <label for="password" class="form-label">Slaptažodis:</label>
            <input type="password" name="password" class="form-input" maxlength="80" value="<?php echo htmlspecialchars($_SESSION['input_password'] ?? ""); ?>">
            <?php
            if (isset($_GET["password"])) {
                echo "<span class = 'error'>*Slaptažodis yra būtinas.</span>";
            }  
            ?>
            <p></p>
            <label for="repeated-passwd" class="form-label">Pakartokite slaptažodį:</label>
            <input type="password" name="repeated-passwd" value="<?php echo htmlspecialchars($_SESSION['input_repeat'] ?? ""); ?>" class="form-input" maxlength="80">
            <?php
            if (isset($_GET["repeated_passwd"])) {
                echo "<span class = 'error'>*Slaptažodis nesutampa.</span>";
            }
            ?>
            <p></p>
            <label for="birthdate" class="form-label">Pasirinkite gimimo datą:</label>
            <input type="date" name="birthdate" min="1920-01-01" max="<?php echo date('Y-m-d'); ?>" class="form-input" lang="lt-LT" value="<?php echo htmlspecialchars($_SESSION['input_birthdate'] ?? ""); ?>">
            <?php
            if (isset($_GET["birthdate"])) {
                echo "<span class = 'error'>*Gim. data yra būtina.</span>";
            }  
            ?>
            <p></p>
            <label for="telephone-number" class="form-label">Telefono nr.:</label>
            <input type="text" name="telephone-number" class="form-input" value="<?php echo htmlspecialchars($_SESSION['input_telephone_number'] ?? ""); ?>">
            <?php
            if (isset($_GET["telephone_number"])) {
                echo "<span class = 'error'>*Telefono nr. yra būtinas.</span>";
            }  
            ?>
            <p></p>
            <label for="user_role" class="form-label">Vartotojo tipas:</label>
            <select name="user_role" id="user_role" class="form-input" required>
                <option value="1">Paprastas vartotojas</option>
                <option value="2">Vadybininkas</option>
                <option value="3">Administratorius</option>
            </select>
            <p></p>
            <input type="submit" value="Sukurti paskyrą" class="form-submit">
        </form>
    </div>
</body>
<footer>
    © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
</footer>

</html>