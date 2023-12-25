<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "updated";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];


    $sql = "DELETE FROM Orders WHERE order_id = $orderId";

    if ($conn->query($sql) === TRUE) {
        echo "<span class='success'>Order deleted successfully</span>";
    } else {
        echo "<span class='error'>Error deleting order: " . $conn->error . "</span>";
    }
} else {
    echo "<span class='error'>Invalid order ID</span>";
}

$conn->close();
?>
