<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "DELETE FROM Customers WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Customer deleted successfully";
        header("Location: view_customer.php");
    } else {
        echo "Error deleting customer: " . $conn->error;
    }
} else {
    echo "No username provided";
}

$conn->close();
?>
