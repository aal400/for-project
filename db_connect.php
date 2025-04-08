<?php
$host = 'localhost';
$dbname = 'noura_path';
$username = 'root'; // تغيير حسب إعداداتك
$password = ''; // تغيير حسب إعداداتك

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>