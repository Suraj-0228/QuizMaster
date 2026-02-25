<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

// Search and Filter Handling
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$categoryFilter = isset($_GET['category']) ? trim($_GET['category']) : '';

// Pagination Variables
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 6; // Set to 6 quizzes per page
$offset = ($page - 1) * $limit;

// Base condition for queries
$whereClauses = ["1=1"]; // Base truth statement
$params = [];

if (!empty($searchQuery)) {
    $whereClauses[] = "(q.title LIKE ? OR q.description LIKE ?)";
    $params[] = "%$searchQuery%";
    $params[] = "%$searchQuery%";
}
if (!empty($categoryFilter)) {
    $whereClauses[] = "c.name = ?";
    $params[] = $categoryFilter;
}

$whereSql = implode(' AND ', $whereClauses);

// 1. Get total count for pagination
$countQuery = "
    SELECT COUNT(q.id) 
    FROM quizzes q 
    LEFT JOIN categories c ON q.category_id = c.id
    WHERE $whereSql
";
$stmt = $pdo->prepare($countQuery);
$stmt->execute($params);
$total_quizzes = $stmt->fetchColumn();

// 2. Calculate total pages
$total_pages = ceil($total_quizzes / $limit);
if ($total_pages == 0) $total_pages = 1;

// 3. Fetch paginated Quizzes securely
$query = "
    SELECT q.*, c.name as category_name, 
    (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) as question_count
    FROM quizzes q 
    LEFT JOIN categories c ON q.category_id = c.id 
    WHERE $whereSql
    ORDER BY q.created_at DESC
    LIMIT $limit OFFSET $offset
";
$stmt = $pdo->prepare($query);
// Execute passing the same params
$stmt->execute($params);
$quizzes = $stmt->fetchAll();

// Fetch Categories for Filter
$categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

$pageTitle = 'Available Quizzes';
include_once '../includes/header.php';
?>