<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $hostname = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "mycart";

    $conn = new mysqli($hostname, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        $registrationMessage = '<div class="message success">Registration successful. You can now <a href="http://localhost/online-shopping/login.html">login</a>.</div>';

    } else {
        $registrationMessage = '<div class="message error">Registration failed.</div>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>

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
    <?php
    if (isset($registrationMessage)) {
        echo $registrationMessage;
    }
    ?>
</body>
</html>
