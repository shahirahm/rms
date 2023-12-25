<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password']; 
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phone_number'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO Staff (username, password, full_name, email, phone_number) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $hashedPassword, $fullName, $email, $phoneNumber);

if ($stmt->execute()) {
    
    header("Location: view_staffs.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
