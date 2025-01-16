<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px;
            padding-left: 40px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }

        .search-bar input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .add-product-btn {
            background: #3498db;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .add-product-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .filters {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 8px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-category {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .product-price {
            font-size: 1.3rem;
            color: #2ecc71;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ecf0f1;
        }

        .product-brand {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn {
            background: #3498db;
            color: white;
        }

        .edit-btn {
            background: #f1c40f;
            color: white;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
        }

        .action-btn:hover {
            opacity: 0.9;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar {
                max-width: 100%;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search products...">
                </div>
                <a href="add_product.php" class="add-product-btn">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
            <div class="filters">
                <select class="filter-select" id="categoryFilter">
                    <option value="">All Categories</option>
                    <?php
                    include 'connection.php';
                    $categories = $conn->query("SELECT DISTINCT p_category FROM products ORDER BY p_category");
                    while($category = $categories->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($category['p_category']) . "'>" . 
                             htmlspecialchars($category['p_category']) . "</option>";
                    }
                    ?>
                </select>
                <select class="filter-select" id="brandFilter">
                    <option value="">All Brands</option>
                    <?php
                    $brands = $conn->query("SELECT DISTINCT p_brand FROM product_detail ORDER BY p_brand");
                    while($brand = $brands->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($brand['p_brand']) . "'>" . 
                             htmlspecialchars($brand['p_brand']) . "</option>";
                    }
                    ?>
                </select>
                <select class="filter-select" id="sortFilter">
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="price_asc">Price (Low to High)</option>
                    <option value="price_desc">Price (High to Low)</option>
                </select>
            </div>
        </div>

        <div class="products-grid">
        <?php
include 'connection.php';

$query = "SELECT * FROM product_detail ORDER BY p_name ASC";
$result = $conn->query($query);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

while ($product = $result->fetch_assoc()) {
?>
    <div class="product-card" data-category="<?php echo htmlspecialchars($product['p_category']); ?>" 
         data-brand="<?php echo htmlspecialchars($product['p_brand']); ?>">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['images']); ?>" 
                 alt="<?php echo htmlspecialchars($product['p_name']); ?>">
        </div>
        <div class="product-info">
            <div class="product-category">
                <?php echo htmlspecialchars($product['p_category']); ?>
            </div>
            <h3 class="product-name">
                <?php echo htmlspecialchars($product['p_name']); ?>
            </h3>
            <div class="product-price">
                $<?php echo number_format($product['price'], 2); ?>
            </div>
            <div class="product-meta">
                <div class="product-brand">
                    <i class="fas fa-trademark"></i>
                    <?php echo htmlspecialchars($product['p_brand']); ?>
                </div>
                <div class="product-actions">
                    <a href="product_details.php?id=<?php echo urlencode($product['product_id']); ?>" 
                       class="action-btn view-btn" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="edit_product.php?id=<?php echo urlencode($product['product_id']); ?>" 
                       class="action-btn edit-btn" title="Edit Product">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteProduct('<?php echo $product['product_id']; ?>')" 
                            class="action-btn delete-btn" title="Delete Product">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterProducts();
        });

        // Category filter
        document.getElementById('categoryFilter').addEventListener('change', filterProducts);
        
        // Brand filter
        document.getElementById('brandFilter').addEventListener('change', filterProducts);
        
        // Sort filter
        document.getElementById('sortFilter').addEventListener('change', filterProducts);

        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const brandFilter = document.getElementById('brandFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;
            
            const products = document.querySelectorAll('.product-card');
            
            products.forEach(product => {
                const name = product.querySelector('.product-name').textContent.toLowerCase();
                const category = product.dataset.category;
                const brand = product.dataset.brand;
                
                const matchesSearch = name.includes(searchTerm);
                const matchesCategory = !categoryFilter || category === categoryFilter;
                const matchesBrand = !brandFilter || brand === brandFilter;
                
                product.style.display = 
                    matchesSearch && matchesCategory && matchesBrand ? 'block' : 'none';
            });

            // Sorting
            const productsArray = Array.from(products);
            productsArray.sort((a, b) => {
                const nameA = a.querySelector('.product-name').textContent;
                const nameB = b.querySelector('.product-name').textContent;
                const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('$', ''));
                const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('$', ''));
                
                switch(sortFilter) {
                    case 'name_asc':
                        return nameA.localeCompare(nameB);
                    case 'name_desc':
                        return nameB.localeCompare(nameA);
                    case 'price_asc':
                        return priceA - priceB;
                    case 'price_desc':
                        return priceB - priceA;
                    default:
                        return 0;
                }
            });

            const grid = document.querySelector('.products-grid');
            productsArray.forEach(product => grid.appendChild(product));
        }

        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = `delete_product.php?id=${productId}`;
            }
        }

        // Add fade-in animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const products = document.querySelectorAll('.product-card');
            products.forEach((product, index) => {
                product.style.opacity = '0';
                setTimeout(() => {
                    product.style.transition = 'opacity 0.5s ease';
                    product.style.opacity = '1';
                }, index * 100);
            });
        });
    </script>
</body>
</html>