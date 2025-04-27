<?php
header("Content-Type: application/json");
require_once("db.php");

$data = json_decode(file_get_contents("php://input"), true);

$userId = intval($data['user_id'] ?? 0);
$quizId = intval($data['quiz_id'] ?? 0);
$score = intval($data['score'] ?? 0);

if (!$userId || !$quizId || $score < 0) {
    echo json_encode(["success" => false, "message" => "Invalid data provided."]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO scores (user_id, quiz_id, score) VALUES (?, ?, ?)");
$stmt->execute([$userId, $quizId, $score]);

echo json_encode(["success" => true, "message" => "Score submitted successfully."]);
?>
