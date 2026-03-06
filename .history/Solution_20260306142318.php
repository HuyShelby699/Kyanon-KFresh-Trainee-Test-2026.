<?php

// 1. Định nghĩa lớp Product (OOP)
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

// Khởi tạo danh sách 5 sản phẩm
$products = [
    new Product(1, "iPhone 15 Pro", 25000000, "Smartphone"),
    new Product(2, "Samsung S24 Ultra", 23000000, "Smartphone"),
    new Product(3, "MacBook M3", 35000000, "Laptop"),
    new Product(4, "Dell XPS 13", 30000000, "Laptop"),
    new Product(5, "Sony WH-1000XM5", 7000000, "Accessories"),
];

/**
 * 2. Hàm lọc sản phẩm theo danh mục
 */
function filterProductsByCategory($products, $categoryName) {
    return array_filter($products, function($product) use ($categoryName) {
        return $product->category === $categoryName;
    });
}

/**
 * 3. Hàm giảm giá cho sản phẩm
 * Trả về danh sách mới với giá đã cập nhật (không ghi đè danh sách cũ)
 */
function applyDiscount($products, $percent) {
    return array_map(function($product) use ($percent) {
        // Clone đối tượng để tránh thay đổi dữ liệu gốc (Immutability)
        $newProduct = clone $product;
        $newProduct->price = $product->price * (1 - $percent / 100);
        return $newProduct;
    }, $products);
}

// --- THỰC THI VÀ HIỂN THỊ KẾT QUẢ ---

echo "--- TẤT CẢ SẢN PHẨM ---<br>";
printProducts($products);

echo "<br>--- LỌC DANH MỤC: Laptop ---<br>";
$laptops = filterProductsByCategory($products, "Laptop");
printProducts($laptops);

echo "<br>--- GIẢM GIÁ 10% TOÀN BỘ SẢN PHẨM ---<br>";
$discountedProducts = applyDiscount($products, 10);
printProducts($discountedProducts);

/**
 * Hàm hỗ trợ in danh sách sản phẩm ra màn hình
 */
function printProducts($productList) {
    if (empty($productList)) {
        echo "Không có sản phẩm nào.<br>";
        return;
    }
    foreach ($productList as $p) {
        echo "ID: {$p->id} | Tên: {$p->name} | Giá: " . number_format($p->price) . " VND | Loại: {$p->category}<br>";
    }
}