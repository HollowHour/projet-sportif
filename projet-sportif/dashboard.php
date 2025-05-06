<?php
session_start();
if (empty($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main>
    <h2>Bienvenue, <?= htmlentities($_SESSION['pseudo']) ?> !</h2>

    <section>
      <h3>Ajouter une activité</h3>
      <form id="act-form">
        <label for="sport">Sport</label>
        <select name="sport" id="sport">
          <option value="course">Course</option>
          <option value="vélo">Vélo</option>
          <option value="muscu">Muscu</option>
        </select><br>

        <label id="dist-label" for="distance">Distance (km)</label>
        <input name="distance" id="distance" placeholder="Distance (km)" required><br>

        <label for="duration">Durée (min)</label>
        <input name="duration" id="duration" placeholder="Durée (min)" required><br>

        <label for="calories">Calories</label>
        <input name="calories" id="calories" placeholder="Calories" required><br>

        <label for="date">Date</label>
        <input name="date" type="datetime-local" required><br>

        <button type="submit">Ajouter</button>
      </form>
      <div id="msg"></div>
    </section>

    <section>
      <h3>Activités récentes</h3>
      <select id="filter">
        <option value="">Tous</option>
        <option value="course">Course</option>
        <option value="vélo">Vélo</option>
        <option value="muscu">Muscu</option>
      </select>
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Sport</th>
            <th>Dist./Charge</th>
            <th>Durée</th>
            <th>Cal</th>
            <th>Utilisateur</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </section>

    <section>
      <h3>Top 5 (calories ce mois)</h3>
      <ul id="top5"></ul>
    </section>
  </main>
  <?php include 'footer.php'; ?>
  <script src="js/main.js"></script>
</body>
</html>