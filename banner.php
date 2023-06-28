<?php
// MySQL server config:
const DB_HOST = 'localhost';
const DB_NAME = 'ellgree';
const DB_USER = 'ellgree';
const DB_PASSWD = '????masked????';

if (empty($_SERVER['HTTP_REFERER'])) {
    die("Wrong usage!");
}
// DB Server connection
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    die('Mysqli module is required!');
}
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
if ($conn->connect_error) {
    die("MySQL connection failed: " . $conn->connect_error);
}

// Check db table existence
$result = $conn->query("SHOW TABLES LIKE 'visitors'");
if ($result->num_rows === 0) {
    $conn->query(file_get_contents('visitors.sql'));
}

// Get visitor's information
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = mysqli_real_escape_string($conn, $_SERVER['HTTP_USER_AGENT']);
$page_url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

$where = "ip_address = '{$ip_address}' AND user_agent = '{$user_agent}' AND page_url = '{$page_url}'";
$result = $conn->query("SELECT * FROM visitors WHERE {$where}");
if ($result->num_rows > 0) { // Visitor exists, increment view_date
    $row = $result->fetch_assoc();
    $views_count = 1 + $row['views_count'];
    $sql = "UPDATE visitors SET `views_count` = '$views_count' WHERE {$where}";
} else { // Insert new visitor
    $views_count = 1;
    $sql = "INSERT INTO visitors (`ip_address`, `user_agent`, `page_url`, `views_count`)
        VALUES ('{$ip_address}', '{$user_agent}', '{$page_url}', {$views_count})";
}
$conn->query($sql);
$conn->close();

// Output the image & prevent caching:
header('Expires: Wed, 1 Jan 1997 00:00:00 GMT');
header('Date: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Content-Type: image/svg+xml');
die("<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"50\" viewBox=\"0 0 300 50\">
    <rect width=\"300\" height=\"50\" fill=\"#ff0000\" />
    <text x=\"50%\" y=\"50%\" fill=\"#ffffff\" dominant-baseline=\"middle\" text-anchor=\"middle\">
        {$page_url}: {$views_count}
    </text>
</svg>");
