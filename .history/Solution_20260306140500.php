<?php

// Định nghĩa lớp Product
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

// 1. Tạo danh sách ít nhất 5 sản phẩm
$products = [
    new Product(1, "Laptop Dell XPS 13", 30000000, "Laptop"),
    new Product(2, "iPhone 15", 25000000, "Phone"),
    new Product(3, "MacBook Pro", 45000000, "Laptop"),
    new Product(4, "Samsung Galaxy S24", 22000000, "Phone"),
    new Product(5, "Logitech MX Master 3", 2500000, "Accessory")
];

// 2. Hàm lọc sản phẩm theo danh mục
function filterProductsByCategory($products, $categoryName) {
    $filtered = [];

    foreach ($products as $product) {
        if ($product->category === $categoryName) {
            $filtered[] = $product;
        }
    }

    return $filtered;
}

// 3. Hàm áp dụng giảm giá
function applyDiscount($products, $percent) {
    $discountedProducts = [];

    foreach ($products as $product) {
        $newPrice = $product->price * (1 - $percent / 100);

        $discountedProducts[] = new Product(
            $product->id,
            $product->name,
            $newPrice,
            $product->category
        );
    }

    return $discountedProducts;
}

// Ví dụ sử dụng

// Lọc sản phẩm thuộc danh mục "Laptop"
$laptops = filterProductsByCategory($products, "Laptop");

echo "Products in Laptop category:\n";
foreach ($laptops as $p) {
    echo $p->name . " - " . $p->price . "\n";
}

// Áp dụng giảm giá 10%
$discounted = applyDiscount($products, 10);

echo "\nProducts after 10% discount:\n";
foreach ($discounted as $p) {
    echo $p->name . " - " . $p->price . "\n";
}

?>