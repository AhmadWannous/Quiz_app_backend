<?php
header("Content-Type: application/json");
require_once("db.php");

$data = json_decode(file_get_contents("php://input"), true);

$questionId = intval($data['id'] ?? 0);
$questionText = trim($data['question_text'] ?? "");
$option1 = trim($data['option_1'] ?? "");
$option2 = trim($data['option_2'] ?? "");
$option3 = trim($data['option_3'] ?? "");
$correctOption = intval($data['correct_option'] ?? 0);

if (!$questionId || !$questionText || !$option1 || !$option2 || !$option3 || !$correctOption) {
    echo json_encode(["success" => false, "message" => "Please fill all fields."]);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE questions SET question_text = ?, option_1 = ?, option_2 = ?, option_3 = ?, correct_option = ? WHERE id = ?");
    $stmt->execute([$questionText, $option1, $option2, $option3, $correctOption, $questionId]);

    echo json_encode(["success" => true, "message" => "Question updated successfully."]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Failed to update question."]);
}
?>
