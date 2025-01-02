<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sarah_krispy";

$servername = "nathstack.tech";
$username = "u257031014_sarah";
$password = "OnGod@@123";
$dbname = "u257031014_sarah";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
