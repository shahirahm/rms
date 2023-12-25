<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM MenuItems";
$result = $conn->query($sql);
$menu_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu Page</title>
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
            color: #fff;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .container {
            margin-left: 250px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            width: calc(20% - 20px);
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-content {
            padding: 10px;
        }

        .card-content h3 {
            margin-top: 0;
        }

        .card-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .add-to-cart,
        .view-item {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: #fff;
        }

        .view-item {
            background-color: #2196F3;
            color: #fff;
        }

        .add-to-cart:hover,
        .view-item:hover {
            background-color: #45a049;
        }

      
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="view_menu.php" class="card-button">View Menu</a>
        <a href="view_order_user.php" class="card-button">View Orders</a>
        <a href="reserver_user.php" class="card-button">Table Reservations</a>
        <a href="promo_user" class="card-button">Promotion Items</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">
        <?php foreach ($menu_items as $item) : ?>
            <div class="card">
                <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['item_name']; ?>">
                <div class="card-content">
                    <h3><?php echo $item['item_name']; ?></h3>
                    <p><?php echo $item['description']; ?></p>
                    <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                    <div class="card-buttons">
                        <button class="add-to-cart" onclick="addToCart('<?php echo $item['item_name']; ?>')">Add to Cart</button>
                        <button class="view-item">View Item</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="notification" id="notification">
        Added to Cart
    </div>

    <script>
        function addToCart(itemName) {
            document.getElementById('notification').style.display = 'block';
            setTimeout(function () {
                document.getElementById('notification').style.display = 'none';
            }, 3000); 
        }
    </script>
</body>

</html>




<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM MenuItems";
$result = $conn->query($sql);
$menu_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        $menu_id = $_POST['menu_id'];

        $sql = "INSERT INTO Cart (customer_id, menu_id, quantity) VALUES ('$customer_id', '$menu_id', 1)";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Item added to cart successfully');</script>";
        } else {
            echo "<script>alert('Failed to add item to cart');</script>";
        }
    } else {
        echo "<script>alert('Please login to add items to the cart');</script>";
    }
}