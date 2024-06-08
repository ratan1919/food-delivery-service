<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_delivery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restaurant_id = $_POST["restaurant_id"];

    $user_query = "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'";
    $user_result = $conn->query($user_query);
    $user = $user_result->fetch_assoc();

    $user_id = $user['id'];

    $order_query = "INSERT INTO orders (user_id, restaurant_id, status) VALUES ('$user_id', '$restaurant_id', 'Pending')";
    
    if ($conn->query($order_query) === TRUE) {
        header("Location: orders.php");
    } else {
        echo "Error: " . $order_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
