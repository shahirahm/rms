<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
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
        input[type="email"],
        input[type="tel"],
        input[type="submit"],
        textarea {
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
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar content -->
        <a href="login.php">Home</a>
        <a href="registration.php">Register</a>
        <a href="login.php">Login As User</a>
        <a href="admin_login.php">Login As Admin</a>
    </div>

    <div class="container">
        <h1>User Registration</h1>
        <form id="registrationForm" method="post">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="text" placeholder="Full Name" name="fullname" required>
            <input type="tel" placeholder="Phone Number" name="phone" required>
            <textarea placeholder="Address" name="address" required></textarea>
            <input type="submit" value="Register" name="submit">
        </form>
    </div>

    <script>
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); 
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
</body>
</html>