<!DOCTYPE html>
<html lang="lt-LT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home page</h1>
    <?php
     
    function add(int $x, int $y) : int {
        return $x + $y;
    }
    
     $ints = [1,12,15,16,22];
     foreach ($ints as $number) {
        echo "<p>$number</p>";
     }
    ?>
</body>
</html>