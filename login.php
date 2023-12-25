<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ff8a00, #e52e71);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }
    </style>
   <script>
        function redirectAfterLogin() {
            setTimeout(function () {
                window.location.href = 'menu.php';
            }, 3000); 
        }
    </script>
</head>

<body>
<div class="sidebar">
     
        <a href="login.php">Home</a>
        <a href="registration.php">Register</a>
        <a href="login.php">Login As User</a>
        <a href="admin_login.php">Login As Admin</a>
    </div>

    <div class="container">
        <h1>User Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="redirectAfterLogin()">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login" name="submit">
        </form>
        <p>Not registered? <a href="registration.php">Register here</a></p>
        <p>Admin? <a href="admin_login.php">Login as Admin</a></p>
    </div>

    <?php
    session_start();

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
        $password = $_POST['password'];

        $hashed_password = sha1($password);

     
        $sql = "SELECT * FROM Customers WHERE username='$username' AND password='$hashed_password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['customer_id'] = $result->fetch_assoc()['customer_id'];
            echo "<script>alert('Login successful'); setTimeout(function(){ window.location.href = 'user_home.php'; }, 3000);</script>";
            exit;
        } else {
            echo "<script>alert('Login failed. Please check your credentials');</script>";
        }
        $conn->close();
    }
    ?>
</body>

</html>




