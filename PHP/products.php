<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Spartan', sans-serif;
}

body {
    background-color: #f7f7f7;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.container {
    width: 100vh
    margin: 0 auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

h1 {
    font-size: 36px;
    color: #222;
    margin-bottom: 20px;
    margin-right: 1000px;
    padding: 15px 0 0 15px;
}

.products-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.product {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: calc(25% - 20px); 
    margin-bottom: 30px;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.product img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
}

.product h2 {
    font-size: 24px;
    color: #222;
    margin-bottom: 10px;
}

.product p {
    font-size: 18px;
    color: #666;
    margin-bottom: 20px;
}

.product-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 15px; 
}

.add-to-cart-button, .view-cart-button {
    background-color: teal;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
    text-decoration: none;
    flex-grow: 1;
}

.add-to-cart-button:hover, .view-cart-button:hover {
    background-color: #008080;
}

.cart-info {
    text-align: right;
    margin-top: 20px;
    font-size: 18px;
}


    </style>
</head>
<body>
    <h1>Products</h1>

    <?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "", "mycart");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>Price: $' . $row['price'] . '</p>';
        echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
        echo '<button class="add-to-cart-button" data-product-id="' . $row['id'] . '">Add to Cart</button>';
        echo '<a href="http://localhost/online-shopping/PHP/cart.php" class="view-cart-button">View Cart</a>';
        echo '</div>';
    }

    if (isset($_SESSION['cart'])) {
        $totalItems = count($_SESSION['cart']);
        echo "<p>Total items in cart: " . $totalItems . "</p>";
    }

    mysqli_close($connection);
    ?>

    <script>
    function addToCart(productId) {
        var xhr = new XMLHttpRequest();
        var url = 'http://localhost/online-shopping/PHP/add_to_cart.php?id=' + productId;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert("Product with ID " + productId + " added to cart!");
                } else {
                    alert("Error adding the product to the cart.");
                }
            }
        };

        xhr.send();
    }

    var addToCartButtons = document.querySelectorAll(".add-to-cart-button");
    addToCartButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var productId = this.getAttribute("data-product-id");
            addToCart(productId);
        });
    });
</script>


</body>
</html>
