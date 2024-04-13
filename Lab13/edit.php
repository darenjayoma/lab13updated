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

// Update Product
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    // You can update other fields similarly
    
    $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Fetch product details
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit;
    }
} else {
    echo "Product ID not provided";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        /* Define CSS styles inline */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
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
    <h2>Edit Product</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label>Price:</label>
        <input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01" min="0" required><br><br>
        <!-- Add other fields here -->
        <input type="submit" name="update" value="Update Product">
    </form>
</body>
</html>
