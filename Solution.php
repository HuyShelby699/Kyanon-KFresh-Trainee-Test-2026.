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

function applyDiscount($products, $percent) {
    return array_map(function($product) use ($percent) {
        $newProduct = clone $product;
        $newProduct->price = $product->price * (1 - $percent / 100);
        return $newProduct;
    }, $products);
}

function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' đ';
}

$selectedCategory = $_GET['category'] ?? 'All';
$discountPercent = 10;

$filteredProducts = filterProductsByCategory($products, $selectedCategory);
$discountedProducts = applyDiscount($filteredProducts, $discountPercent);

$categories = ["All", "Smartphone", "Laptop", "Accessories"];

// map giá gốc theo id để đối chiếu
$originalMap = [];
foreach ($filteredProducts as $product) {
    $originalMap[$product->id] = $product;
}
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
            max-width: 1100px;
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
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
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

        .section-title {
            margin: 20px 0 15px;
            font-size: 18px;
            font-weight: bold;
            color: #4a6178;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-left: 5px solid #20b2aa;
            padding-left: 10px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .product-card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .product-card p {
            margin: 10px 0;
            font-size: 16px;
        }

        .old-price {
            text-decoration: line-through;
            color: #888;
            margin-right: 8px;
        }

        .new-price {
            color: #ff3b30;
            font-weight: bold;
            font-size: 18px;
        }

        .category {
            display: inline-block;
            margin-top: 12px;
            background: #eef2ff;
            color: #333;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
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

    <div class="section-title">Sản phẩm</div>

    <?php if (empty($discountedProducts)): ?>
        <div class="empty">Không có sản phẩm nào trong danh mục này.</div>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($discountedProducts as $product): ?>
                <div class="product-card">
                    <h3><?= htmlspecialchars($product->name) ?></h3>
                    <p>ID: <?= $product->id ?></p>
                    <p>
                        <span class="old-price"><?= formatPrice($originalMap[$product->id]->price) ?></span>
                        <span class="new-price"><?= formatPrice($product->price) ?></span>
                    </p>
                    <span class="category"><?= htmlspecialchars($product->category) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>