<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Menu Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
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

        .container {
            width: 50%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

    <div class="container">
        <h1>Add Menu Item</h1>
        <form action="process_menu_item.php" method="post">
            <input type="text" name="item_name" placeholder="Item Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <select name="category_id" required>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "updated";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM Categories";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
        
                        }
                    }
                    $conn->close();
                ?>
            </select>
            <input type="text" name="image_url" placeholder="Image URL">
            <input type="submit" value="Add Item" name="submit">
        </form>
    </div>
</body>

</html>
