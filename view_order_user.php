<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Order History</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: salmon;
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
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

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

        
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="sidebar">

        <a href="view_menu.php" class="card-button">View Menu</a>
        <a href="view_order_user.php" class="card-button">View Orders</a>
        <a href="view_table.php" class="card-button">Table Reservations</a>
        <a href="view_promotion.php" class="card-button">Promotion Items</a>
        <a href="#" class="logout">Logout</a>
    </div>

    <div class="content">
        <h1>User Order History</h1>

        <?php
    session_start();

    if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
  
    } else {
     
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

        

        if (isset($_SESSION['customer_id'])) {
            $customer_id = $_SESSION['customer_id'];

            $sql = "SELECT order_id, order_date, total_amount, payment_status, fulfillment_status
                    FROM Orders
                    WHERE customer_id = $customer_id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Order ID</th><th>Order Date</th><th>Total Amount</th><th>Payment Status</th><th>Fulfillment Status</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['order_id']}</td><td>{$row['order_date']}</td><td>{$row['total_amount']}</td><td>{$row['payment_status']}</td><td>{$row['fulfillment_status']}</td></tr>";
                }

                echo '</table>';
            } else {
                echo "No orders found.";
            }
        } else {
            echo "User not logged in.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
