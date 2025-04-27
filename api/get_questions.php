<?php
header("Content-Type: application/json");
require_once("db.php");

$quizId = intval($_GET['quiz_id'] ?? 0);

if (!$quizId) {
    echo json_encode(["success" => false, "message" => "Quiz ID is required."]);
    exit;
}

$stmt = $conn->prepare("SELECT id, question_text, option_1, option_2, option_3 FROM questions WHERE quiz_id = ?");
$stmt->execute([$quizId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "questions" => $questions]);
?>
