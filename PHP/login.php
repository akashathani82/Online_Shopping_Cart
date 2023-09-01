<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hostname = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "mycart";

    $conn = new mysqli($hostname, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['user_email'] = $user["email"];

            header("Location: http://localhost/online-shopping/PHP/products.php");
            exit(); 
            
        } else {
            $loginMessage = '<div class="message error">Invalid Password.</div>';
        }
    } else {
        $loginMessage = '<div class="message error">User not found.</div>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-weight: bold;
            width: 300px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <?php

    if (isset($loginMessage)) {
        echo $loginMessage;
    }
    ?>
</body>
</html>
