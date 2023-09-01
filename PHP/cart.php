<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="http://localhost/online-shopping/CSS/style.csss">
</head>
<body>

<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "", "mycart");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (empty($_SESSION['cart'])) {
        echo '<p>Your cart is empty.</p>';
    } else {
        $productIDs = array_keys($_SESSION['cart']);
        $sql = "SELECT * FROM products WHERE id IN (" . implode(",", $productIDs) . ")";
        $result = mysqli_query($connection, $sql);

        echo '<table>';
        echo '<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>';

        $totalAmount = 0;

        foreach ($_SESSION['cart'] as $productID => $quantity) {
            $query = "SELECT * FROM products WHERE id = $productID";
            $result = mysqli_query($connection, $query);
            $product = mysqli_fetch_assoc($result);

            $productPrice = $product['price'];
            $productTotal = (float)$productPrice * (int)$quantity;

            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['price']}</td>";
            echo "<td>{$quantity['quantity']}</td>";
            echo "<td>$productTotal</td>";
            echo '<td><button class="remove-from-cart-button" onclick="removeFromCart(' . $product['id'] . ')">Remove</button></td>';
            echo "</tr>";
        
            $totalAmount += $productTotal; 
        }
        


        echo '<tr><td colspan="3">Total:</td><td>$' . $totalAmount . '</td></tr>';
        echo '</table>';

        if (!empty($_SESSION['cart'])) {
            echo '<a href="http://localhost/online-shopping/PHP/checkout.php" class="checkout-button">Proceed to Checkout</a>';
        }
    }


    mysqli_close($connection);
    ?>

<script>
    function removeFromCart(productId) {
        var xhr = new XMLHttpRequest();

        var url = 'http://localhost/online-shopping/PHP/remove_from_cart.php';
        var formData = new FormData();
        formData.append('product_id_to_remove', productId);

        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                } else {
                    alert('Error removing the product from the cart.');
                }
            }
        };

        xhr.send(formData);
    }
</script>

    

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
        }

        .checkout-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: teal;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }

        .empty-cart-message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

        .remove-from-cart-button {
            background-color: #ff5252;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-from-cart-button:hover {
            background-color: #ff0000;
        }

    </style>
</body>
</html>

