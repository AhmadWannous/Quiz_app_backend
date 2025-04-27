<?php
header("Content-Type: application/json");
require_once("db.php");

$data = json_decode(file_get_contents("php://input"), true);
$questionId = intval($data['id'] ?? 0);

if (!$questionId) {
    echo json_encode(["success" => false, "message" => "Question ID is required."]);
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$questionId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true, "message" => "Question deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Question not found."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Failed to delete question."]);
}
?>
