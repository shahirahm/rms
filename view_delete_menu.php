<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Menu Items</title>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    width: 80%;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}


.delete-button {
    background-color: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.delete-button:hover {
    background-color: #ff3333;
}

    </style>
</head>

<body>
    <div class="container">
        <h1>Menu Items</h1>
        <?php
     
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "updated";

     
        $conn = new mysqli($servername, $username, $password, $dbname);

      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $sql = "SELECT * FROM MenuItems";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category ID</th>
                    <th>Image URL</th>
                    <th>Action</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["menu_id"] . "</td>
                        <td>" . $row["item_name"] . "</td>
                        <td>" . $row["description"] . "</td>
                        <td>" . $row["price"] . "</td>
                        <td>" . $row["category_id"] . "</td>
                        <td>" . $row["image_url"] . "</td>
                        <td><form action='delete_menu_item.php' method='post'>
                        </td> href='?delete_id=" . $row["menu_id"] . "
                            <input type='hidden' name='menu_id' value='" . $row["menu_id"] . "'>
                            <input type='submit' class='delete-button' value='Delete'>
                        </form></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>
