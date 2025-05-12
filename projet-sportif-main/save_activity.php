<?php
session_start();
include 'config.php';
// si pas connecté, on sort
if (empty($_SESSION['id'])) exit;

// on recupere les stats de l'activite
$s = mysqli_real_escape_string($conn, $_POST['sport']);
$d = (float) $_POST['distance'];
$t = (int)   $_POST['duration'];
$c = (int)   $_POST['calories'];
$dt= mysqli_real_escape_string($conn, $_POST['date']);

// on insere dans la base
mysqli_query($conn,
  "INSERT INTO activities(user_id,sport,distance,duration,calories,date)
   VALUES({$_SESSION['id']},'$s',$d,$t,$c,'$dt')"
);

echo 'ok';