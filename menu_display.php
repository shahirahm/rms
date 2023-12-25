<!DOCTYPE html>
<html>
<head>
  <title>Menu Display</title>
  <style>
    .menu-card {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin: 10px;
      width: 300px;
      display: inline-block;
    }
    .menu-card img {
      width: 100%;
      height: auto;
    }
    .menu-card .menu-details {
      padding: 10px;
    }
    .add-to-cart-btn {
      display: block;
      width: 100%;
      margin-top: 10px;
      padding: 5px;
      text-align: center;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="menu-container">

<?php
session_start(); 

if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];


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

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menu-card">';
            echo '<img src="' . $row['image_url'] . '" alt="' . $row['item_name'] . '">';
            echo '<div class="menu-details">';
            echo '<h3>' . $row['item_name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Price: $' . $row['price'] . '</p>';
            echo '<form method="post" action="add_to_cart.php">';
            echo '<input type="hidden" name="menu_id" value="' . $row['menu_id'] . '">';
            echo '<button type="submit" class="add-to-cart-btn" name="add_to_cart">Add to Cart</button>';
            echo '</form>';
            echo '</div></div>';
        }
    } else {
        echo "No menu items found";
    }

    $conn->close();
} else {
    echo "Please log in to add items to the cart";
}
?>

</div>

</body>
</html>
