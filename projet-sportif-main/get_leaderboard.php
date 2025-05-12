<?php
include 'config.php';
header('Content-Type: application/json');

// ranking par calories
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
//executer la commande sql
$res = mysqli_query($conn, $sql);

//composer l'output en liste
$out = [];
while ($row = mysqli_fetch_assoc($res)) {
  $out[] = $row;
}

echo json_encode($out);
