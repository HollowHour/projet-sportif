<?php
//comme dans getleaderboard.php
session_start();
include 'config.php';
header('Content-Type: application/json');
//pour assurer que la session de l'util est active
if (empty($_SESSION['id'])) {
  echo json_encode([]);
  exit;
}

$uid = (int) $_SESSION['id'];
$sql = "
  SELECT
    id,
    date,
    sport,
    distance,
    duration,
    calories
  FROM activities
  WHERE user_id = $uid
  ORDER BY date DESC
";
$res = mysqli_query($conn, $sql);

$out = [];
while ($row = mysqli_fetch_assoc($res)) {
  $out[] = $row;
}

echo json_encode($out);
