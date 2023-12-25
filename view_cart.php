<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <style>
        
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

      
        .container {
            margin-left: 250px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
     
        <a href="#">Home</a>
        <a href="#">View Orders</a>
        <a href="#">View Tables</a>
        <a href="#">View Menu Items</a>
        <a href="#">View Reservations</a>
    </div>

    <div class="container">
        <h1>Cart</h1>

        <?php
       
        session_start();
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
          
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "updated";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

    
            $query = "SELECT * FROM Cart WHERE customer_id='$user_id'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Cart ID</th><th>Customer ID</th><th>Menu ID</th><th>Quantity</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['cart_id'] . "</td><td>" . $row['customer_id'] . "</td><td>" . $row['menu_id'] . "</td><td>" . $row['quantity'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Cart is empty.";
            }

            $conn->close();
        } else {
            echo "Please login to view your cart.";
        }
        ?>
    </div>
</body>

</html>
