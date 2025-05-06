<?php
session_start();
include 'config.php';
// Si pas connecté, on sort
if (empty($_SESSION['id'])) exit;

// On récupère et on échappe
$s = mysqli_real_escape_string($conn, $_POST['sport']);
$d = (float) $_POST['distance'];
$t = (int)   $_POST['duration'];
$c = (int)   $_POST['calories'];
$dt= mysqli_real_escape_string($conn, $_POST['date']);

// On insère
mysqli_query($conn,
  "INSERT INTO activities(user_id,sport,distance,duration,calories,date)
   VALUES({$_SESSION['id']},'$s',$d,$t,$c,'$dt')"
);

// On renvoie OK
echo 'ok';