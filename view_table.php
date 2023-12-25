<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Table Reservations</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #6B5;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #444;
        }

        .container {
            margin-left: 250px;
            padding: 20px;
        }

        .card-button {
            display: inline-block;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #333;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card-button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .logout {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['customer_id'])) {
        header("Location: login.php");
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "updated";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Tables WHERE table_status = 'Available'";
    $result = $conn->query($sql);
    ?>

<div class="sidebar">
        <a href="view_menu.php" class="card-button">View Menu</a>
        <a href="view_order_user.php" class="card-button">View Orders</a>
        <a href="view_table.php" class="card-button">Table Reservations</a>
        <a href="view_promotion.php" class="card-button">Promotion Items</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">
        <h1>Table Reservations</h1>
        <h2>Available Tables</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>Table Number: " . $row["table_number"] . " (Seating Capacity: " . $row["seating_capacity"] . ")</p>";
                echo "<form action='make_reservation.php' method='post'>";
                echo "<input type='hidden' name='table_id' value='" . $row["table_id"] . "'>";
                echo "<input type='number' name='people_count' placeholder='Number of People' required>";
                echo "<input type='submit' value='Book Table'>";
                echo "</form>";
            }
        } else {
            echo "<p>No tables available.</p>";
        }
        ?>
    </div>
</body>

</html>
