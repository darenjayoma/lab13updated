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

// Add Product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    
    // Upload Image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image = $target_file;
    $sql = "INSERT INTO products (name, price, image) VALUES ('$name', $price, '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            margin-top: 0;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Darker Green */
        }
    </style>
</head>
<body>
    <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" min="0" required><br><br>
        <label>Image:</label>
        <input type="file" name="image" required><br><br>
        <input type="submit" value="Add Product">
    </form>
    <a href="display.php"><button>View Products</button></a>
</body>
</html>
