<?php
$host = "localhost";
$dbname = "quiz_db"; 
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!";
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database connection failure data: " . $e->getMessage()]));
}
?>
