<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $p = mysqli_real_escape_string($conn, $_POST['pseudo']);
  $e = mysqli_real_escape_string($conn, $_POST['email']);
  $h = password_hash($_POST['pass'], PASSWORD_DEFAULT);

  // Vérification doublon
  $r = mysqli_query($conn, 
    "SELECT 1 FROM users
     WHERE email='$e' OR pseudo='$p' LIMIT 1"
  );
  if (mysqli_fetch_row($r)) {
    $error = 'Pseudo ou email déjà pris';
  } else {
    mysqli_query($conn,
      "INSERT INTO users(pseudo,email,pass)
       VALUES('$p','$e','$h')"
    );
    header('Location: login.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Inscription</h2>
    <?php if(isset($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" action="register.php">
      <input name="pseudo" placeholder="Pseudo" required><br>
      <input name="email" type="email" placeholder="Email" required><br>
      <input name="pass"  type="password" placeholder="Mot de passe" required><br>
      <button type="submit">S'inscrire</button>
    </form>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>

