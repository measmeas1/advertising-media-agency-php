<?php
include '../../config/database.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? 'All';

$sql = "SELECT * FROM services WHERE title LIKE '%$search%'";

if ($category !== 'All') {
    $sql .= " AND category = '$category'";
}

$result = $conn->query($sql);
?>