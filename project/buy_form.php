<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cafeina";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        $stmt = $conn->prepare("INSERT INTO orderlist (name, address, email, phone, product, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssi', $name, $address, $email, $phone, $product, $quantity);
        $stmt->execute();
        echo "Order placed successfully. Thank you.";

        $stmt->close();
    } else {
        // Order failed
        echo "Sorry, there was an error processing your order.";
    }
}

$conn->close();
?>
