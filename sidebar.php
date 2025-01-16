<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
        }
        
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px;
            transition: 0.3s;
        }
        
        .sidebar .nav-link:hover {
            background: #34495e;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        .main-content {
            background: #f8f9fa;
        }
        
        .stat-card {
            border-radius: 10px;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .recent-orders {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* New styles for dropdown */
        .sidebar .dropdown-menu {
            background: #34495e;
            border: none;
            margin-left: 20px;
            width: 90%;
        }

        .sidebar .dropdown-item {
            color: #ecf0f1;
            padding: 10px 15px;
        }

        .sidebar .dropdown-item:hover {
            background: #2c3e50;
            color: #fff;
        }

        .sidebar .dropdown-toggle::after {
            float: right;
            margin-top: 8px;
        }

        /* Indent dropdown items */
        .sidebar .dropdown-menu .nav-link {
            padding-left: 25px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <!-- Products Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-box"></i>
                                Products
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                <li>
                                    <a class="dropdown-item" href="productInsertForm.php">
                                        <i class="fas fa-plus-circle"></i>
                                        Add Product
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-edit"></i>
                                        Update Product
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-trash-alt"></i>
                                        Delete Product
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="allproductDisplay.php">
                                        <i class="fas fa-list"></i>
                                        View All Products
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users"></i>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-line"></i>
                                Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content (same as before) -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Previous main content remains the same -->
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

             

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // Previous Chart.js code remains the same
    </script>
</body>
</html>