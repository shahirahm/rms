<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "updated";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $raw_password = $_POST['password']; 
    $hashed_password = sha1($raw_password); 
    $email = $_POST['email'];
    $full_name = $_POST['fullname'];
    $phone_number = $_POST['phone'];
    $address = $_POST['address'];


    $stmt = $conn->prepare("SELECT username FROM Customers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_username = $stmt->get_result();
    $stmt->close();

 
    $stmt = $conn->prepare("SELECT email FROM Customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_email = $stmt->get_result();
    $stmt->close();

    $message = "";

    if ($result_username->num_rows > 0 && $result_email->num_rows > 0) {
        $message = "Username and Email already exist!";
    } elseif ($result_username->num_rows > 0) {
        $message = "Username already exists!";
    } elseif ($result_email->num_rows > 0) {
        $message = "Email already exists!";
    } else {
      
        $stmt = $conn->prepare("INSERT INTO Customers (username, password, email, full_name, phone_number, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $hashed_password, $email, $full_name, $phone_number, $address);

     
        if ($stmt->execute()) {
            $customer_id = $conn->insert_id; 
            $message = "Registration successful! Customer ID: " . $customer_id;
        } else {
            $message = "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }

    echo json_encode(['message' => $message]);
    exit();
}
?>
