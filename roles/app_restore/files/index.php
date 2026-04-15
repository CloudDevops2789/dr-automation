<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "druser", "drpass", "drdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ADD */
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $conn->query("INSERT INTO products (name, price) VALUES ('$name', '$price')");
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cloud DR App</title>

    <style>
        body {
            font-family: Arial;
            background: url('https://images.unsplash.com/photo-1518770660439-4636190af475');
            background-size: cover;
            color: white;
            text-align: center;
        }

        .container {
            width: 60%;
            margin: auto;
            margin-top: 40px;
            background: rgba(0,0,0,0.7);
            padding: 20px;
            border-radius: 12px;
        }

        h1 {
            color: #00ffcc;
        }

        input, button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: none;
        }

        button {
            background: #00ffcc;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #00ffcc;
            color: black;
        }

        a {
            color: #00ffcc;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>CLOUD DR WEB SERVER</h1>

    <h2>Add Product</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <button type="submit" name="add">Add</button>
    </form>

    <h2>Product List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM products");

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['price']."</td>
                    <td><a href='?delete=".$row['id']."'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
