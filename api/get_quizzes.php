<?php
header("Content-Type: application/json");
require_once("db.php");

$title = trim($_POST['title'] ?? '');
$created_by = intval($_POST['created_by'] ?? 0);

if (!$title || !$created_by) {
    echo json_encode(["status" => "error", "message" => "Missing quiz title or creator ID."]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO quizzes (title, created_by) VALUES (?, ?)");
$stmt->execute([$title, $created_by]);

echo json_encode(["status" => "success", "quiz_id" => $conn->lastInsertId()]);
?>
