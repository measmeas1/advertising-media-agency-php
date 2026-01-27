<?php
$pdo = require_once __DIR__ . '/../../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Service ID is required");
}

$sql = "
    SELECT 
        products.id,
        products.title,
        products.description,
        products.price,
        categories.name AS category,
        product_details.duration,
        product_details.platform,
        product_details.target_audience
    FROM products
    JOIN categories ON products.category_id = categories.id
    LEFT JOIN product_details ON product_details.product_id = products.id
    WHERE products.id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$service = $stmt->fetch();

if (!$service) {
    die("Service not found");
}
?>