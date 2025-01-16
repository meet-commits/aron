<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
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
        
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .product-header {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: white;
            padding: 2rem;
            position: relative;
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
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateX(-5px);
        }

        .product-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .product-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            font-size: 1.1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .product-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .product-image {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-info {
            padding: 1rem;
        }

        .info-section {
            margin-bottom: 2rem;
        }

        .info-title {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-content {
            color: #34495e;
            line-height: 1.6;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .price {
            font-size: 2rem;
            color: #2ecc71;
            font-weight: bold;
            margin: 1rem 0;
        }

        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .product-content {
                grid-template-columns: 1fr;
            }

            .product-meta {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php
    // Include database connection
    include 'connection.php';
    include 'sidebar.php';

    // Get product ID from URL
    $product_id = $_GET['id'] ?? 0;

    // Prepare and execute query
    $query = "SELECT * FROM product_detail WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    ?>
    <div class="container">
        <div class="product-header">
            <a href="products.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
            <h1 class="product-title"><?php echo htmlspecialchars($product['p_name']); ?></h1>
            <div class="product-meta">
                <div class="meta-item">
                    <i class="fas fa-tag"></i>
                    <span><?php echo htmlspecialchars($product['p_category']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-trademark"></i>
                    <span><?php echo htmlspecialchars($product['p_brand']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-code-branch"></i>
                    <span><?php echo htmlspecialchars($product['p_model_type']); ?></span>
                </div>
            </div>
        </div>

        <div class="product-content">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['images']); ?>" alt="<?php echo htmlspecialchars($product['p_name']); ?>">
            </div>

            <div class="product-info">
                <div class="price">
                    $<?php echo number_format($product['price'], 2); ?>
                </div>

                <div class="info-section">
                    <h2 class="info-title">
                        <i class="fas fa-info-circle"></i>
                        Description
                    </h2>
                    <div class="info-content">
                        <?php echo nl2br(htmlspecialchars($product['p_description'])); ?>
                    </div>
                </div>

                <div class="info-section">
                    <h2 class="info-title">
                        <i class="fas fa-clipboard-list"></i>
                        Product Details
                    </h2>
                    <div class="info-content">
                        <p><strong>Product ID:</strong> <?php echo htmlspecialchars($product['product_id']); ?></p>
                        <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['p_brand']); ?></p>
                        <p><strong>Model:</strong> <?php echo htmlspecialchars($product['p_model_type']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($product['p_category']); ?></p>
                    </div>
                </div>

                <div class="actions">
                    <a href="edit_product.php?id=<?php echo urlencode($product['product_id']); ?>" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit Product
                    </a>
                    <button class="btn btn-delete" onclick="deleteProduct('<?php echo $product['product_id']; ?>')">
                        <i class="fas fa-trash"></i> Delete Product
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo '<div class="container"><h1>Product not found</h1></div>';
    }
    $stmt->close();
    $conn->close();
    ?>

    <script>
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = `delete_product.php?id=${productId}`;
            }
        }

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