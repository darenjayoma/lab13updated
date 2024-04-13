<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab13";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete Product
if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Display Products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Price: $" . $row["price"] . "<br>";
        echo '<img src="' . $row["image"] . '" alt="Product Image" width="150"><br>';
        
        // Edit button with link to edit page
        echo '<a href="edit.php?id=' . $row["id"] . '"><button>Edit</button></a>';
        
        // Delete button
        echo '<form action="" method="post">';
        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
        echo '<button type="submit" name="delete">Delete</button>';
        echo '</form>';
        
        echo "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        /* Define CSS styles inline */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; /* Darker Green */
        }
    </style>
</head>
<body>
    <h2>Products</h2>
</body>
</html>
