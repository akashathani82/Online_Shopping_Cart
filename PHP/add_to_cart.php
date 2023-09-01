<?php
session_start();

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "mycart";

    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products WHERE id = $productID";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $product = mysqli_fetch_assoc($result);

    mysqli_close($connection);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (array_key_exists($productID, $_SESSION['cart'])) {
        $_SESSION['cart'][$productID]['quantity']++;
    } else {
        $_SESSION['cart'][$productID] = array(
            'id' => $productID,
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'image' => $product['image']
        );
    }

    header("Location: http://localhost/online-shopping/PHP/products.php");
    header("Location: http://localhost/online-shopping/PHP/cart.php");

    exit();
} else {
    echo "Invalid request!";
}
?>
