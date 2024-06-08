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

$user_query = "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

$orders_query = "
    SELECT orders.id, restaurants.name AS restaurant_name, orders.status, orders.created_at 
    FROM orders 
    JOIN restaurants ON orders.restaurant_id = restaurants.id 
    WHERE orders.user_id = $user_id
";
$orders_result = $conn->query($orders_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style=" background-image: linear-gradient(to right, #2f65e3, #4ee1aa, #59c6d1, #4ee1aa, #73b9f5)">
    <div class="container" style="    background-image: linear-gradient(to right, #2f65e3, #4ee1aa, #59c6d1, #4ee1aa, #73b9f5);
">
        <h2>Your Orders</h2>
        <table border="1" cellspacing="4" cellpadding="4">
            <tr>
                <th>Order ID</th>
                <th>Restaurant</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
            <?php
            while ($row = $orders_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['restaurant_name'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="dashboard.php" style="color: white;">Back to Dashboard</a>
        <a href="logout.php" style="color: white;">Logout</a>
    </div>
</body>
</html>
