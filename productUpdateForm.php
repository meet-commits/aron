<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .back-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .form-content {
            padding: 2rem;
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
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .preview-image {
            max-width: 200px;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-update {
            background: #2ecc71;
            color: white;
        }

        .btn-cancel {
            background: #e74c3c;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .success-message {
            background: #2ecc71;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                margin: 1rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php
    include 'connection.php';

    $success_message = '';
    $error_message = '';
    
    // Get product ID from URL
    $product_id = $_GET['id'] ?? '';
    
    // Fetch product data
    if ($product_id) {
        $query = "SELECT * FROM product_detail WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $p_category = $_POST['p_category'];
        $p_name = $_POST['p_name'];
        $price = $_POST['price'];
        $p_description = $_POST['p_description'];
        $p_brand = $_POST['p_brand'];
        $p_model_type = $_POST['p_model_type'];
        $images = $_POST['images'];

        $update_query = "UPDATE products SET 
                        p_category = ?, 
                        p_name = ?, 
                        price = ?, 
                        p_description = ?, 
                        p_brand = ?, 
                        p_model_type = ?, 
                        images = ? 
                        WHERE product_id = ?";

        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssdsssss", 
                         $p_category, 
                         $p_name, 
                         $price, 
                         $p_description, 
                         $p_brand, 
                         $p_model_type, 
                         $images, 
                         $product_id);

        if ($stmt->execute()) {
            $success_message = "Product updated successfully!";
            // Refresh product data
            $result = $conn->query("SELECT * FROM product_detail WHERE product_id = '$product_id'");
            $product = $result->fetch_assoc();
        } else {
            $error_message = "Error updating product: " . $conn->error;
        }
    }
    ?>

    <div class="container">
        <div class="form-header">
            <a href="products.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
            <h1>Update Product</h1>
        </div>

        <div class="form-content">
            <?php if ($success_message): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($product): ?>
                <form method="POST" action="" id="updateForm">
                    <div class="form-group">
                        <label for="p_category">Category:</label>
                        <input type="text" id="p_category" name="p_category" 
                               value="<?php echo htmlspecialchars($product['p_category']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="p_name">Product Name:</label>
                        <input type="text" id="p_name" name="p_name" 
                               value="<?php echo htmlspecialchars($product['p_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" 
                               value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="p_description">Description:</label>
                        <textarea id="p_description" name="p_description" rows="4" required><?php 
                            echo htmlspecialchars($product['p_description']); 
                        ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="p_brand">Brand:</label>
                        <input type="text" id="p_brand" name="p_brand" 
                               value="<?php echo htmlspecialchars($product['p_brand']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="p_model_type">Model Type:</label>
                        <input type="text" id="p_model_type" name="p_model_type" 
                               value="<?php echo htmlspecialchars($product['p_model_type']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="images">Image URL:</label>
                        <input type="text" id="images" name="images" 
                               value="<?php echo htmlspecialchars($product['images']); ?>" required>
                        <?php if ($product['images']): ?>
                            <img src="<?php echo htmlspecialchars($product['images']); ?>" 
                                 alt="Product Image" class="preview-image">
                        <?php endif; ?>
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="update" class="btn btn-update">
                            <i class="fas fa-save"></i> Update Product
                        </button>
                        <a href="products.php" class="btn btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            <?php else: ?>
                <div class="error-message">Product not found.</div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Form validation
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            const price = document.getElementById('price').value;
            if (price < 0) {
                e.preventDefault();
                alert('Price cannot be negative!');
                return false;
            }
        });

        // Preview image when URL changes
        document.getElementById('images').addEventListener('change', function(e) {
            const url = e.target.value;
            const previewImage = document.querySelector('.preview-image');
            if (previewImage) {
                previewImage.src = url;
            }
        });

        // Add fade-in animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.container').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.container').style.transition = 'opacity 0.5s ease';
                document.querySelector('.container').style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>