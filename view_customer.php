<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Customers</title>
    <style>
        
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            color: red;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
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
<body>
    <h1>Admin Panel - Customers</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "updated";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Customers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["full_name"] . "</td>
                        <td>" . $row["phone_number"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td><a href='delete_customer.php?username=" . $row["username"] . "'>Delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No customers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>

</html>
