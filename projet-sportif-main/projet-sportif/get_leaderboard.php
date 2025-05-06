<?php
include 'config.php';
header('Content-Type: application/json');

// Classement basé sur les calories cumulées
$sql = "
  SELECT
    u.pseudo,
    SUM(a.calories) AS total_cal
  FROM activities a
  JOIN users u ON u.id = a.user_id
  WHERE MONTH(a.date) = MONTH(CURDATE())
  GROUP BY u.id
  ORDER BY total_cal DESC
  LIMIT 5
";

$res = mysqli_query($conn, $sql);
if (!$res) {
  // En cas d’erreur SQL, on renvoie l’erreur pour débug
  echo json_encode(['error' => mysqli_error($conn)]);
  exit;
}

$out = [];
while ($row = mysqli_fetch_assoc($res)) {
  $out[] = $row;
}

echo json_encode($out);
