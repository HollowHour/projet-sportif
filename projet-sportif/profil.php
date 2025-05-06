<?php
session_start();
if (empty($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Profil</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>

    <!-- Mes infos -->
    <section>
      <h2>Mes informations</h2>
      <form id="user-form">
        <input type="text"    name="pseudo" value="<?=htmlentities($_SESSION['pseudo'])?>" required><br>
        <input type="email"   name="email"  value="" placeholder="Email" required><br>
        <input type="password"name="pass"   placeholder="Nouveau mot de passe"><br>
        <button type="submit">Mettre à jour</button>
      </form>
      <div id="user-msg"></div>
    </section>

    <!-- Mes activités -->
    <section>
      <h2>Mes activités</h2>
      <table>
        <thead>
          <tr>
            <th>Date</th><th>Sport</th><th>Détail</th>
            <th>Durée</th><th>Cal</th><th>Actions</th>
          </tr>
        </thead>
        <tbody id="profile-acts"></tbody>
      </table>
    </section>

  </main>
  <?php include 'footer.php'; ?>
  <script src="js/profile.js"></script>
</body>
</html>
