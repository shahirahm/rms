<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];


    $sql = "DELETE FROM MenuItems WHERE menu_id = $menu_id";

    if ($conn->query($sql) === TRUE) {
        echo "Menu item deleted successfully";
    } else {
        echo "Error deleting menu item: " . $conn->error;
    }
} else {
    echo "No menu_id provided";
}

$conn->close();
?>
