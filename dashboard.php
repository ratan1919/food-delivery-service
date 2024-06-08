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

$restaurants_query = "SELECT * FROM restaurants";
$restaurants_result = $conn->query($restaurants_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background: url('https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGZvb2R8ZW58MHx8MHx8fDA%3D');">

    <div class="row">
        <div class="col-md-6">
            <div class="container" style="    background-image: linear-gradient(to right, #2f65e3, #4ee1aa, #59c6d1, #4ee1aa, #73b9f5);
        ">
                <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
                <h3>Available Restaurants</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
            while ($row = $restaurants_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td><form action='order.php' method='post'><input type='hidden' name='restaurant_id' value='" . $row['id'] . "'><input type='submit' value='Order Now'></form></td>";
                echo "</tr>";
            }
            ?>
                </table>
                <a href="logout.php">Logout</a>
            </div>


        </div>

        <div class="col-md-6">
            <p style="font-family: monospace;padding: 50px; line-height: 28px;color: white;font-size: 18px;">
                Online food ordering revolutionizes dining, offering convenience and variety at the tap of a screen. With a vast array of cuisines and restaurants to choose from, customers can browse menus, customize orders, and pay securely within minutes. From local favorites to international delicacies, options cater to diverse tastes and dietary preferences. Real-time tracking keeps patrons informed about their order's status, enhancing transparency and minimizing uncertainties. Additionally, user reviews and ratings provide insights for informed decision-making. Seamless integration with delivery services ensures timely arrivals, while promotions and discounts sweeten the deal. With just a few clicks, online food ordering delivers culinary delights to doorsteps effortlessly. Additionally, user reviews and ratings provide insights for informed decision-making. Seamless integration with delivery services ensures timely arrivals, while promotions and discounts sweeten the deal. With just a few clicks, online food ordering delivers culinary delights to doorsteps effortlessly.
            </p>
        </div>
    </div>

</body>

</html>