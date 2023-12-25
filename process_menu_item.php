<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO MenuItems (item_name, description, price, category_id, image_url) 
            VALUES ('$item_name', '$description', '$price', '$category_id', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New menu item added successfully');</script>";
        header("Location: add_menu_item.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
