<?php
header("Content-Type: application/json");
require_once("db.php");

$title = trim($_POST['title'] ?? '');
$created_by = intval($_POST['created_by'] ?? 0);

if (!$title || !$created_by) {
    echo json_encode(["success" => false, "message" => "Missing quiz title or creator ID."]);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO quizzes (title, created_by) VALUES (?, ?)");
    $stmt->execute([$title, $created_by]);

    echo json_encode([
        "success" => true,
        "quiz_id" => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Failed to create quiz."]);
}
?>
