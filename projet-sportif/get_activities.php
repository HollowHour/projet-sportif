<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'config.php';

$sport = $_GET['sport'] ?? '';

$sql  = "SELECT a.date, a.sport, a.distance, a.duration, a.calories, u.pseudo
         FROM activities a
         JOIN users u ON u.id = a.user_id";
$params = [];
if ($sport !== '') {
  $sql .= " WHERE a.sport = ?";
  $params[] = $sport;
}
$sql .= " ORDER BY a.date DESC LIMIT 10";

$stmt = mysqli_prepare($conn, $sql);
if (count($params)) {
  mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
}
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$rows = [];
while ($row = mysqli_fetch_assoc($res)) {
  $rows[] = $row;
}

echo json_encode($rows);