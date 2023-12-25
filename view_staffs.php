<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Staff</title>
    <style>
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

        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .content form {
            margin-bottom: 20px;
        }

        .content form input[type="submit"] {
            background-color: #337ab7;
            color: white;
            border: none;
            cursor: pointer;
        }

        .content form input[type="submit"]:hover {
            background-color: #286090;
        }

        table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}
    </style>
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
        <h1>Admin Panel - Staff</h1>

        <h2>Staff List</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
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

            $sql = "SELECT * FROM Staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["full_name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["phone_number"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No staff found</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <h2>Add New Staff</h2>
        <form action="add_staff.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="submit" value="Add Staff">
        </form>
    </div>
</body>

</html>
