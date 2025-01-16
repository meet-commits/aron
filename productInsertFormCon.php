<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $p_category = $_POST['p_category'];
    $p_name = $_POST['p_name'];
    $price = $_POST['price'];
    $p_description = $_POST['p_description'];
    $p_brand = $_POST['p_brand'];
    $p_model_type = $_POST['p_model_type'];
    $images = $_POST['images'];

    $sql = "INSERT INTO Product (product_id, p_category, p_name, price, p_description, p_brand, p_model_type, images)
    VALUES ('$product_id', '$p_category', '$p_name', '$price', '$p_description', '$p_brand', '$p_model_type', '$images')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
