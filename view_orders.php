<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100%;
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
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .result-message {
            margin-top: 10px;
            padding: 5px;
            border-radius: 4px;
        }
        .success {
            background-color: #4CAF50;
            color: white;
        }
        .error {
            background-color: #f44336;
            color: white;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            color: white;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }
    </style>
    <script>
        function deleteOrder(orderId) {
            if (confirm("Are you sure you want to delete this order?")) {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("result-" + orderId).innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "delete_order.php?id=" + orderId, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>

<div class="sidebar">

<a href="create_category.php">Category</a>
        <a href="add_menu_item.php">Menu</a>
        <a href="view_reservations.php">Reservations</a>
        <a href="view_tables.php">Table</a>
        <a href="view_orders.php">Orders</a>
        <a href="view_feedback.php">Feedbacks</a>
        <a href="view_staffs.php">Staffs</a>
        <a href="view_customer.php">Users</a>
        <a href="logout.php" class="logout">Logout</a>
</div>

<div class="content">
    <h1>Customer Orders</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Fulfillment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        
            $servername = "localhost"; 
            $username = "root";
            $password = "";
            $dbname = "updated";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Orders.order_id, Orders.customer_id, Customers.full_name AS customer_name, Orders.order_date, Orders.total_amount, Orders.payment_status, Orders.fulfillment_status
                    FROM Orders
                    INNER JOIN Customers ON Orders.customer_id = Customers.customer_id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["order_id"] . "</td>
                            <td>" . $row["customer_id"] . "</td>
                            <td>" . $row["customer_name"] . "</td>
                            <td>" . $row["order_date"] . "</td>
                            <td>" . $row["total_amount"] . "</td>
                            <td>" . $row["payment_status"] . "</td>
                            <td>" . $row["fulfillment_status"] . "</td>
                            <td><button class='delete-btn' onclick='deleteOrder(" . $row["order_id"] . ")'>Delete</button>
                            <div id='result-" . $row["order_id"] . "' class='result-message'></div></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
