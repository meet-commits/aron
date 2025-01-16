<?php
session_start();
include 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $p_category = $_POST['p_category'];
    $p_name = $_POST['p_name'];
    $price = $_POST['price'];
    $p_description = $_POST['p_description'];
    $p_brand = $_POST['p_brand'];
    $p_model_type = $_POST['p_model_type'];
    
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["images"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["images"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["images"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["images"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO Product_detail (product_id, p_category, p_name, price, p_description, p_brand, p_model_type, images)
    VALUES ('$product_id', '$p_category', '$p_name', '$price', '$p_description', '$p_brand', '$p_model_type', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Your existing styles here */
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            padding: 2rem;
            margin-top: 2rem;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            position: relative;
        }

        h2::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: #3498db;
            margin: 10px auto;
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #34495e;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .submit-btn {
            background: #3498db;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .form-group i {
            position: absolute;
            right: 12px;
            top: 40px;
            color: #95a5a6;
        }

        .success {
            border-color: #2ecc71 !important;
        }

        .error {
            border-color: #e74c3c !important;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="container">
        <h2>Add New Product</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" id="product_id" name="product_id" required>
                <i class="fas fa-barcode"></i>
            </div>
            <div class="form-group">
                <label for="p_category">Category</label>
                <input type="text" id="p_category" name="p_category" required>
                <i class="fas fa-tags"></i>
            </div>
            <div class="form-group">
                <label for="p_name">Product Name</label>
                <input type="text" id="p_name" name="p_name" required>
                <i class="fas fa-box"></i>
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" required>
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="form-group">
                <label for="p_description">Description</label>
                <textarea id="p_description" name="p_description" rows="4" required></textarea>
                <i class="fas fa-align-left"></i>
            </div>
            <div class="form-group">
                <label for="p_brand">Brand</label>
                <input type="text" id="p_brand" name="p_brand" required>
                <i class="fas fa-trademark"></i>
            </div>
            <div class="form-group">
                <label for="p_model_type">Model Type</label>
                <input type="text" id="p_model_type" name="p_model_type" required>
                <i class="fas fa-code-branch"></i>
            </div>
            <div class="form-group">
                <label for="images">Images</label>
                <input type="file" id="images" name="images" required>
                <i class="fas fa-images"></i>
            </div>
            <button type="submit" class="submit-btn" name="submit">Submit Product</button>
        </form>
    </div>
    <script>
        /* Your existing scripts here */
    </script>
</body>
</html>
