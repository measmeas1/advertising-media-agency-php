<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? 'All';

$sql = "
    SELECT 
        products.id,
        products.title,
        products.description,
        products.price,
        categories.name AS category
    FROM products
    JOIN categories ON products.category_id = categories.id
    WHERE products.title LIKE :search
";

$params = [
    ':search' => "%$search%"
];

if ($category !== 'All') {
    $sql .= " AND categories.name = :category";
    $params[':category'] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$result = $stmt;
?>
