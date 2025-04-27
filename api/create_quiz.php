<?php
$host = "localhost";
$dbname = "quiz_app";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = isset($_POST['title']) ? trim($_POST['title']) : null;
$created_by = isset($_POST['created_by']) ? intval($_POST['created_by']) : null;

if (!$title || !$created_by) {
    echo json_encode(["status" => "error", "message" => "Missing quiz title or creator ID."]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO quizzes (title, created_by) VALUES (?, ?)");
$stmt->bind_param("si", $title, $created_by);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "quiz_id" => $stmt->insert_id]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create quiz."]);
}

$stmt->close();
$conn->close();
