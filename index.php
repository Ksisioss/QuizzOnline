<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ma page rétro</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1 class="neon-text">Quizz informatique</h1>
    <p class="neon-text">>Bonne chance et que les bits soient avec vous !</p>
    <br>
    <form method='post' action="quizz.php">
      <input class="retro-input" type="text" name="nickname" value="Pseudo">
      <input class="retro-button" type="submit" name="nickSet" value="Jouer !">
    </form>
    <?php
      // Connect to database
      $conn = new mysqli("localhost", "root", "ksisiosksisios", "quizz");

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Retrieve top 10 scores from database
      $sql = "SELECT * FROM scores ORDER BY score DESC LIMIT 10";
      $result = $conn->query($sql);

      // Display top 10 scores
      if ($result->num_rows > 0) {
        echo "<h2>Meilleurs scores:</h2>";
        echo "<ol class='form-text'>";
        while ($row = $result->fetch_assoc()) {
          echo "<li>" . $row["name"] . " - " . $row["score"] . "</li>";
        }
        echo "</ol>";
      } else {
        echo "<p>Aucun score trouvé dans la base de données.</p>";
      }

      // Close database connection
      $conn->close();
    ?>
  </div>
</body>
</html>
