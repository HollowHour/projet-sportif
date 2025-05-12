<?php
// pour demarer la session au cas ou
if (session_status()===PHP_SESSION_NONE) {
  session_start();
}
?>
<nav>
  <?php if (!empty($_SESSION['id'])): ?>
    <a href="dashboard.php">Dashboard</a>
    <a href="profil.php">Mon Profil</a>
    <a href="logout.php">Déconnexion</a>
  <?php else: ?>
    <a href="login.php">Connexion</a>
    <a href="register.php">Inscription</a>
  <?php endif; ?>
</nav>
