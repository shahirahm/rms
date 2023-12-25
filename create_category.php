<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .content {
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
        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        delete-button {
            background-color: #f44336;
        }

        .delete-button:hover {
            background-color: #d32f2f;}
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
        <h1>Category Management</h1>

        <h2>Categories Delete</h2>
        <table>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
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

            $sqlFetch = "SELECT * FROM Categories";
            $result = $conn->query($sqlFetch);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["category_id"] . "</td><td>" . $row["category_name"] . "</td><td><a href='?delete_id=" . $row["category_id"] . "' class='delete-button'>Delete</a></td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No categories found</td></tr>";
            }

            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $sqlDelete = "DELETE FROM Categories WHERE category_id=$delete_id";
                if ($conn->query($sqlDelete) === TRUE) {
                    echo "<script>alert('Category deleted successfully'); window.location.href = 'create_category.php';</script>";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            $conn->close();
            ?>
        </table>
        
        <h2>Add Category</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="category_name" placeholder="Category Name" required>
            <input type="submit" value="Add Category" name="submit">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category_name = $_POST['category_name'];

          
            $conn = new mysqli($servername, $username, $password, $dbname);

          
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO Categories (category_name) VALUES ('$category_name')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Category added successfully');</script>";
                echo "<meta http-equiv='refresh' content='0'>"; 
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        
        ?>
        
    </div>
</body>

</html>
