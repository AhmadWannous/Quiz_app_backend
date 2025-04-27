<?php
header("Content-Type: application/json");
require_once("db.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if (!$email || !$password) {
    echo json_encode(["success" => false, "message" => "Please provide email and password."]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user["password"])) {
    echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    exit;
}

unset($user["password"]);
echo json_encode(["success" => true, "user" => $user]);
