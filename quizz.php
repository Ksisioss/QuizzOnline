<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ma page rétro</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container ">
    <h1 class="neon-text">Quizz informatique</h1>
    <p > Bonne chance et que les bits soient avec vous !</p>
    <div class="content form-text">
      <?php
        // Start session and set current question index to 0
        session_start();
        if (!isset($_SESSION['current_question'])) {
          $_SESSION['current_question'] = 0;
          $_SESSION['score'] = 0;
          $_SESSION['nickname'] = $_POST['nickname'];
        }
        // Connect to database
        $conn = new mysqli("localhost", "root", "ksisiosksisios", "quizz");

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve questions from database
        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);

        // If there are questions, display the current question
        if ($result->num_rows > 0) {
          $questions = $result->fetch_all(MYSQLI_ASSOC);
          $current_question = $_SESSION['current_question'];
          $question = $questions[$current_question];
          if(isset($_POST['submit'])){
            $answer = $_POST['answer'];
            $correct_answer = $question['answer'];
            if ($answer == $correct_answer) {
              echo "<p class='feedback correct'>Correct ! </p> <br>";
              $_SESSION['score']++;
            } else {
              echo "<p class='feedback false'>Pas vraiment, c'était la réponse  " . $correct_answer . "</p> <br>";
            }
            $current_question++;
            $_SESSION['current_question'] = $current_question;
            if($_SESSION['current_question'] < count($questions)) {
              $question = $questions[$current_question];
            }
          }
          if($_SESSION['current_question'] < count($questions)) {
            echo "<form method='post'>";
            echo "<p>" . $question['question'] . "</p>";
            echo "<label><input type='radio' name='answer' value='1' required>" . $question['option1'] . "</label><br>";
            echo "<label><input type='radio' name='answer' value='2' required>" . $question['option2'] . "</label><br>";
            echo "<label><input type='radio' name='answer' value='3' required>" . $question['option3'] . "</label><br>";
            echo "<label><input type='radio' name='answer' value='4' required>" . $question['option4'] . "</label><br>";
            echo "<label><input type='submit' name='submit' value='Suivant' class='retro-button'>";
            echo "</form>";
          }
          else {
            echo "<p class='final-score'>Your final score is: " . $_SESSION['score'] . "/" . count($questions) . "</p>";
            $currentDate = date('Y-m-d H:i:s');
            $sql2 = "INSERT INTO scores (name, score, date) VALUES ('".$_SESSION['nickname']."', ".$_SESSION['score'].", '".$currentDate."')";
            $result = $conn->query($sql2);
            session_destroy();
            echo "<a href='index.php'> <input class='retro-button' type='button' value='Accueil'> </a>";
          }
        } else {
          echo "0 questions found in the database.";
        }

        // Close database connection
        $conn->close();
      ?>
      
    </div>
  </div>
</body>
</html>
