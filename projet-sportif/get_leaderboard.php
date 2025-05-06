<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'config.php';

$sql = "SELECT u.pseudo, SUM(a.distance) AS tot
        FROM activities a
        JOIN users u ON u.id = a.user_id
        WHERE MONTH(a.date) = MONTH(CURDATE())
        GROUP BY u.id
        ORDER BY tot DESC
        LIMIT 5";

$res = mysqli_query($conn, $sql);
$list = [];
while ($u = mysqli_fetch_assoc($res)) {
  $list[] = $u;
}

echo json_encode($list);