<?php
session_start();
include 'config.php';

//verification du email et mdp
if ($_SERVER['REQUEST_METHOD']==='POST') {
  //on retire l'email si il existe et le mdp
  $e = mysqli_real_escape_string($conn, $_POST['email']);
  $r = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$e' LIMIT 1"
  );
  if ($u = mysqli_fetch_assoc($r)) {
    //verification du mdp
    if (password_verify($_POST['pass'], $u['pass'])) {
      $_SESSION['id']     = $u['id'];
      $_SESSION['pseudo'] = $u['pseudo'];
      header('Location: dashboard.php');
      exit;
    }
  }
  $error = 'Identifiants incorrects';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Connexion</h2>
    <!-- si mdp ou email existe pas -->
    <?php if(isset($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
      <input name="email" type="email" placeholder="Email" required><br>
      <input name="pass"  type="password" placeholder="Mot de passe" required><br>
      <button type="submit">Se connecter</button>
    </form>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>
