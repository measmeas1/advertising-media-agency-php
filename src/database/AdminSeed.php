<?php
$pdo = require_once __DIR__ . '/../config/db.php';

$email = "admin@example.com";
$password = password_hash("123456", PASSWORD_DEFAULT);

// Check if admin already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if ($user) {
    echo "Admin already exists!";
    exit;
}

// Insert new admin
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 'admin')");
$stmt->execute([
    'name' => 'Admin',
    'email' => $email,
    'password' => $password
]);

echo "Admin created successfully!";
