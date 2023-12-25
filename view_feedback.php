<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Feedback</title>
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
        <h1>Feedbacks</h1>
        <table>
            <tr>
                <th>Feedback ID</th>
                <th>Customer ID</th>
                <th>Feedback Text</th>
                <th>Feedback Date</th>
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

            $sql = "SELECT * FROM Feedback";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["feedback_id"] . "</td>
                        <td>" . $row["customer_id"] . "</td>
                        <td>" . $row["feedback_text"] . "</td>
                        <td>" . $row["feedback_date"] . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No feedback found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>
