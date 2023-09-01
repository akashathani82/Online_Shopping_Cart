<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "mycart";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="http://localhost/online-shopping/CSS/style.css">
</head>
<body>
    <h1>Checkout</h1>

    <h2>Order Summary</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
        $totalAmount = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
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
                echo "</tr>";
            
                $totalAmount += $productTotal;
            }
            
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if user is logged in
            $userID = 1; 
        
            $shippingAddress = $_POST['shipping_address'];
            $paymentMethod = $_POST['payment_method'];
        
            $totalAmount = 0;
            foreach ($_SESSION['cart'] as $productID => $quantity) {
                $query = "SELECT price FROM products WHERE id = $productID";
                $result = mysqli_query($connection, $query);
                $productPriceData = mysqli_fetch_assoc($result);
                $productPrice = $productPriceData['price'];
                
                $productTotal = (float) $productPrice * (int) $quantity;

                $totalAmount += $productTotal;
            }
        

            $insertOrderQuery = "INSERT INTO orders (user_id, total_amount, shipping_address, payment_method)
                                 VALUES ($userID, $totalAmount, '$shippingAddress', '$paymentMethod')";
            mysqli_query($connection, $insertOrderQuery);
        
            $orderID = mysqli_insert_id($connection);

            foreach ($_SESSION['cart'] as $productID => $quantity) {
                $productPrice = 0; 
            
                $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price_per_item)
                VALUES ('$orderID', '$productID', " . (int)$quantity . ", '$productPrice')";

                if (mysqli_query($connection, $insertOrderItemQuery)) {
                  
                } else {
                echo "Error inserting order item: " . mysqli_error($connection);
                echo "SQL Query: " . $insertOrderItemQuery;
                }

            

            }
            
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
 
            echo "Order placed successfully!";
            echo '<div class="confirmation-message">';
            echo '<h2>Order Confirmation</h2>';
            echo '<p>Thank you for your order!</p>';
            echo '<p>Order ID: ' . $orderID . '</p>';
            echo '<p>Total Amount: $' . number_format($totalAmount, 2) . '</p>';
            echo '<p>Shipping Address: ' . htmlspecialchars($shippingAddress) . '</p>';
            echo '<p>Payment Method: ' . htmlspecialchars($paymentMethod) . '</p>';
    

            echo '<h3>Items Purchased:</h3>';
            echo '<ul>';

            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productID => $quantity) {
                $query = "SELECT name FROM products WHERE id = $productID";
                $result = mysqli_query($connection, $query);
                $product = mysqli_fetch_assoc($result);

                echo '<li>' . htmlspecialchars($product['name']) . ' (Quantity: ' . $quantity . ')</li>';
                }
            }
            
            echo '</ul>';
    
            echo '</div>';
        }
        ?>
        <tr>
            <th colspan="3">Total Amount:</th>
            <td><?php echo "$totalAmount"; ?></td>
        </tr>
    </table>

    <h2>Shipping Information</h2>
    <form method="post" action="">
        <label for="shipping_address">Shipping Address:</label>
        <input type="text" id="shipping_address" name="shipping_address" required>
        
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">Amazon pay</option>
            <option value="paypal">Phone pay</option>
            <option value="paypal">Google pay</option>
            <option value="paypal">Paytm</option>
        </select>
        
        <button type="submit">Confirm Order</button>
    </form>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
        }

        .confirmation-message {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: teal;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }


    </style>
</body>
</html>
