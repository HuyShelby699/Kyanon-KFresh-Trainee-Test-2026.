<?php

class Product {
    public $id;
    public $name;
    public $price;
    public $category;

    public function __construct($id, $name, $price, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }
}

$products = [
    new Product(1, "iPhone 15 Pro", 25000000, "Smartphone"),
    new Product(2, "Samsung S24 Ultra", 23000000, "Smartphone"),
    new Product(3, "MacBook M3", 35000000, "Laptop"),
    new Product(4, "Dell XPS 13", 30000000, "Laptop"),
    new Product(5, "Sony WH-1000XM5", 7000000, "Accessories"),
];

function filterProductsByCategory($products, $categoryName) {
    if ($categoryName === '' || $categoryName === 'All') {
        return $products;
    }

    return array_filter($products, function($product) use ($categoryName) {
        return $product->category === $categoryName;
    });
}

function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' đ';
}

$selectedCategory = $_GET['category'] ?? 'All';
$filteredProducts = filterProductsByCategory($products, $selectedCategory);

$categories = ["All", "Smartphone", "Laptop", "Accessories"];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .filter-box {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        select, button {
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .product-card h3 {
            margin-top: 0;
            font-size: 18px;
        }

        .price {
            color: #e53935;
            font-weight: bold;
            margin: 10px 0;
        }

        .category {
            display: inline-block;
            background: #eef2ff;
            color: #333;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
        }

        .empty {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách sản phẩm</h1>

        <div class="filter-box">
            <form method="GET">
                <label for="category"><strong>Lọc theo danh mục:</strong></label>
                <select name="category" id="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>>
                            <?= $category ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Lọc</button>
            </form>
        </div>

        <?php if (empty($filteredProducts)): ?>
            <div class="empty">Không có sản phẩm nào trong danh mục này.</div>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($filteredProducts as $product): ?>
                    <div class="product-card">
                        <h3><?= htmlspecialchars($product->name) ?></h3>
                        <p>ID: <?= $product->id ?></p>
                        <p class="price"><?= formatPrice($product->price) ?></p>
                        <span class="category"><?= htmlspecialchars($product->category) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>