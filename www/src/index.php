<?php
 use Models\User;
 use Models\Product;
 require __DIR__ . "/config.php";
 require __DIR__ . '/../vendor/autoload.php';
 require __DIR__ . '/utils.php';

 session_start();

/*
PLEASE DONT JUDGE ME FOR THIS SHITTY HACK, USERS WONT SEE IT ANYWAY
*/
// Fetch all products
$products = Product::all();

// Initialize filters
$searchQuery = isset($_POST['search']) ? test_input($_POST['search']) : '';
$selectedManufacturers = $_POST['manufacturer'] ?? [];
$selectedTitles = $_POST['title'] ?? [];
$selectedModels = $_POST['model'] ?? [];
$selectedCategories = $_POST['category'] ?? [];
$selectedPrice = isset($_POST['filter_price']) ? floatval($_POST['filter_price']) : null;
$searchWords = array_filter(explode(' ', $searchQuery)); // Remove any empty words
// Apply filters
$filteredProducts = $products->filter(function ($product) use (
    $selectedManufacturers,
    $selectedTitles,
    $selectedModels,
    $selectedCategories,
    $searchWords,
    $selectedPrice
) {

    
    // Check if product matches all search words
    if (!empty($searchWords)) {
        $matchesAllWords = true;
        foreach ($searchWords as $word) {
            $fieldsToSearch = [
                $product->title,
                $product->manufacturer,
                $product->model,
                $product->category
            ];

            $matchesWord = false;
            foreach ($fieldsToSearch as $field) {
                if (stripos($field, $word) !== false) {
                    $matchesWord = true;
                    break;
                }
            }

            if (!$matchesWord) {
                $matchesAllWords = false;
                break;
            }
        }
        if (!$matchesAllWords) {
            return false; // If any word doesn't match, exclude this product
        }
    }

    if (!empty($selectedManufacturers) && !in_array($product->manufacturer, $selectedManufacturers)) {
        return false;
    }
    // Filter by title
    if (!empty($selectedTitles) && !in_array($product->title, $selectedTitles)) {
        return false;
    }
    // Filter by model
    if (!empty($selectedModels) && !in_array($product->model, $selectedModels)) {
        return false;
    }
    // Filter by category
    if (!empty($selectedCategories) && !in_array($product->category, $selectedCategories)) {
        return false;
    }
    // Filter by price
    $discountedPrice = calculate_discount($product->unit_price, $product->discount);
    if ($selectedPrice !== null && $discountedPrice < $selectedPrice) {
        return false;
    }
    return true;
});


?>
<!DOCTYPE html>
<html lang="lt-LT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/form-styles.css" type="text/css">
    <link rel="stylesheet" href="src/styles/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Pagrindinis puslapis</title>
</head>

<body>
    <h1>
        Visos prekės
        <?php
        if (isset($_GET["cart"])) {
            echo "<p class ='success' style='font-size: 20px;'>Prekė sėkmingai idėta į krepšelį.</p>";
        }
        if (isset($_GET["produce"])) {
            echo "<p class ='success' style='font-size: 20px;'>Prekė sėkmingai įtraukta į katalogą.</p>";
        }
        ?>
        <form action="" method="post">
        <input type="text" class="form-input" name="search" placeholder="Įveskite paieškos terminą." style="margin:0 auto; margin-left:40rem; position:relative; top:-15px;width:25rem;">
        <button class="form-submit-smaller" style="width:60px !important; padding: 10px; position:relative; border-radius:20px; left:0px; top:-6px;">
            <img src="src/images/search.svg" alt="search" class="search-thumb">
        </button>
        </form>
        
    </h1>
    <img src="src/images/cart.svg" alt="cart" class="smaller-img-top-right" style="margin-right: 40px;"><a href="src/cart-page.php"
    style="text-decoration:none; right:40px;" class="smaller-img-top-right"></a>
    <img src="src/images/acount-icon.svg" alt="face" class="smaller-img-top-right"><a href="src/login-page.php"
        style="text-decoration:none" class="smaller-img-top-right"></a>
    <?php
    if (isset($_SESSION['user_id'])) {
        $user = User::find($_SESSION['user_id']);
        echo "<p class='text-top-right'>{$user->email}</p>";
        echo "<a href='src/actions/logout.php' class='logout-btn-top-right'>Atsijungti</a>";
    }
    if (isset($_SESSION["cart"])) {
        $total_amount = count($_SESSION["cart"]);
        echo "<a class='logout-btn-top-right' style='right:43px; width:10px; padding:10px;'>{$total_amount}</a>";
    }
    $manufacturers = $products->map(function ($product) { return $product->manufacturer;})->unique();
    $titles = $products->map(function ($product) {return $product->title;})->unique();
    $models = $products->map(function ($product) {return $product->model;})->unique();
    $categories = $products->map(function ($product) {return $product->category;})->unique();
    $price_max  = $products->filter(function ($product) {return $product->discount >= 1;})
    ->map(function ($product) {return calculate_discount($product->unit_price, $product->discount);})->max();
    echo "<div class = 'shop wrapper'>";
    echo "<div class = 'filter-container'>";
    echo "      <form method = 'post'>
                  <h2 class = 'form-heading' style='margin-left:0px;'>Filtravimas</h2>";
    echo                "<p></p>";
    echo                 "<label class = 'form-label' style='margin-left:0px;'>Gamintojas</label>";
    echo                "<p></p>";
    foreach ($manufacturers as $manufacturer) {
        $alreadyClicked = in_array($manufacturer, $selectedManufacturers) ? "checked" : "";
    echo "<input type = 'checkbox' class = 'form-input-smaller' style='margin-left:0px; width:1rem;' name= 'manufacturer[]' value={$manufacturer} $alreadyClicked>";
    echo "<label for={$manufacturer} class='form-label' style='margin-left:0px;'>{$manufacturer}</label>";
    echo "<p></p>";
    }
    echo                 "<label class = 'form-label' style='margin-left:0px;'>Pavadinimas</label>";
    echo                "<p></p>";
    foreach ($titles as $title) {
        $alreadyClicked = in_array($title, $selectedTitles) ? "checked" : "";
        echo "<input type = 'checkbox' class = 'form-input-smaller' style='margin-left:0px; width:1rem;' name ='title[]' value={$title} $alreadyClicked>";
        echo "<label for={$title} class='form-label' style='margin-left:0px;'>{$title}</label>";
        echo "<p></p>";
        }
    echo                 "<label class = 'form-label' style='margin-left:0px;'>Modelis</label>";
    echo                "<p></p>";
    foreach ($models as $model) {
        $alreadyClicked = in_array($model, $selectedModels) ? "checked" : "";
        echo "<input type = 'checkbox' class = 'form-input-smaller' style='margin-left:0px; width:1rem;' name ='model[]' value={$model} $alreadyClicked>";
        echo "<label for={$model} class='form-label' style='margin-left:0px;'>{$model}</label>";
        echo "<p></p>";
        }
    echo                 "<label class = 'form-label' style='margin-left:0px;'>Paskirtis/Kategorija</label>";
    echo                "<p></p>";
    foreach ($categories as $category) {
        $alreadyClicked = in_array($category, $selectedCategories) ? "checked" : "";
        echo "<input type = 'checkbox' class = 'form-input-smaller' style='margin-left:0px; width:1rem;' name ='category[]' value={$category} $alreadyClicked>";
        echo "<label for={$category} class='form-label' style='margin-left:0px;'>{$category}</label>";
        echo "<p></p>";
        }
        echo                 "<label class = 'form-label' style='margin-left:0px;'>Kaina</label>";
        echo                "<p></p>";
        $priceValue = $selectedPrice ?? 0;
        echo             "<input type='range' min=1' max='{$price_max}' value='{$priceValue}' class='slider' id='slider' step='0.1' name='filter_price'>";
        echo                "<p></p>";
        echo             "<p id='slider-value'>$priceValue</p>";
        echo                "<p></p>";
    echo            "<input type='submit' class='form-submit-smaller' style='margin-left:0rem; !important; width:10rem;' value='Filtruoti'>";
    echo         "</form>";
    echo  "</div>";
    echo "<div class = 'items'>";
    foreach ($filteredProducts as $product) {
        $price_text = "<p class = 'item-text-price'>" . calculate_discount($product->unit_price, $product->discount) . "€/vnt</p>";
        if ($product->discount >= 1) {
            $price_text .= "<p class='item-text-discount'>" . round($product->discount, 1) . "% Nuolaida</p>";
        }
        echo "<div class = 'item'>";
        echo "<p class ='item-title'>{$product->title}</p>";
        echo "<p class = 'item-text-general'>{$product->manufacturer}</p>";
        echo "<p class = 'item-text-general'>{$product->category} </p>";
        echo "<p class = 'item-text-general'>{$product->model} </p>";
        echo Product::image_str($product->id);
        echo $price_text;
        echo "<form action='src/actions/to-cart.php' method='post'>";
        echo "<label for='quantity-{$product->id}' class='item-label'>Kiekis:</label>";
        echo "<input type='number' id='quantity-{$product->id}' name='quantity' min='1' max={$product->total_units} class='form-input-smaller' style='margin-left:0rem !important; width:10rem !important;'>";
        echo "<input type='hidden' name='prod_id' value='{$product->id}'>"; // Pass the product ID
        echo "<input type='submit' class='form-submit-smaller' style='margin-left:0rem; !important; width:10rem;' value='Į krepšelį'>";
        echo "</form>";
    
    echo "</div>";
    }
    echo "</div>";
    echo "</div>"
    ?>
    <script>
    // Get the slider and the span element
        const slider = document.getElementById("slider");
        const sliderValue = document.getElementById("slider-value");
        // Update the span element with the current value of the slider
        slider.addEventListener("input", function () {
            sliderValue.textContent = slider.value; // Display the slider's value
            });
    </script>
    <footer>
        © Marius Ambrazevičius IFF-2/4 KTU IF <?php echo date("Y") . " m." ?>
    </footer>
</body>

</html>