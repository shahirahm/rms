<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
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
    </style>
</head>

<body>

    <div class="sidebar">
    <<a href="create_category.php">Category</a>
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
        <h1>Admin Panel</h1>
        <a href="create_category.php" class="card-button">Category</a>
        <a href="add_menu_item.php" class="card-button">Menu</a>
        <a href="view_reservations.php" class="card-button">Reservations</a>
        <a href="view_tables.php" class="card-button">Table</a>
        <a href="view_orders.php" class="card-button">Orders</a>
        <a href="view_feedback.php" class="card-button">Feedbacks</a>
        <a href="view_staffs.php" class="card-button">Staffs</a>
        <a href="view_users.php" class="card-button">Users</a>
    </div>

</body>

</html>
