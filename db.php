
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "sql211.infinityfree.com"; // from InfinityFree MySQL section
$user = "if0_39330248";         // your database username
$pass = "uCYSP1denAgWT"; 
$dbname = "if0_39330248_epiz_2006_taskmanager"; // your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
