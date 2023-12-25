<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "updated";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['customer_id'];
    $table_number = $_POST['table_number'];
    $number_of_people = $_POST['number_of_people'];

    $check_query = "SELECT * FROM Tables WHERE table_number = $table_number AND table_status = 'Available'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $insert_query = "INSERT INTO Reservations (customer_id, reservation_date_time, number_of_people, table_number, reservation_status)
                         VALUES ($customer_id, NOW(), $number_of_people, $table_number, 'Pending')";

        if ($conn->query($insert_query) === TRUE) {
            echo "<script>alert('Reservation request sent successfully!');</script>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Table is not available for reservation.');</script>";
    }
}

$conn->close();
?>
