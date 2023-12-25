<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <script>
        function logoutAndRedirect() {
            alert('Logged out');
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);
        }
    </script>
</head>

<body onload="logoutAndRedirect()">
    <p>Logging out...</p>
</body>

</html>
