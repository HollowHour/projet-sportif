<?php
include 'config.php';
header('Content-Type: application/json');
//on retire les items necessaires de notre base
$f = $_GET['sport'] ?? '';
$sql = "SELECT a.date,a.sport,a.distance,a.duration,a.calories,u.pseudo
        FROM activities a
        JOIN users u ON u.id=a.user_id";
if ($f!=='') {
  $f = mysqli_real_escape_string($conn,$f);
  $sql .= " WHERE a.sport='$f'";
}
//dates decroissants
$sql .= " ORDER BY a.date DESC LIMIT 10";

$res = mysqli_query($conn,$sql);
$out = [];
while ($row = mysqli_fetch_assoc($res)) {
  $out[] = $row;
}
echo json_encode($out);