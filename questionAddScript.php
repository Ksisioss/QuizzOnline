<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "ksisiosksisios";
$dbname = "quizz";

$conn = new mysqli($host, $username,$password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Tableau de questions à insérer
$questions = array(
    array(
        "question" => "Quel est le langage de programmation le plus utilisé au monde ?",
        "option1" => "Python",
        "option2" => "Java",
        "option3" => "C++",
        "option4" => "JavaScript",
        "answer" => 2
    ),
    array(
        "question" => "Qu'est-ce qu'un algorithme ?",
        "option1" => "Un ordinateur",
        "option2" => "Un programme",
        "option3" => "Une séquence d'instructions",
        "option4" => "Une base de données",
        "answer" => 3
    ),
    array(
        "question" => "Quel est le langage de programmation utilisé pour créer des applications Android ?",
        "option1" => "Swift",
        "option2" => "C#",
        "option3" => "Java",
        "option4" => "Python",
        "answer" => 3
    ),
    array(
        "question" => "Qu'est-ce qu'un langage de programmation ?",
        "option1" => "Une langue parlée",
        "option2" => "Une langue écrite",
        "option3" => "Un ensemble de règles",
        "option4" => "Un moyen de communiquer avec un ordinateur",
        "answer" => 4
    ),
    array(
        "question" => "Qu'est-ce qu'un compilateur ?",
        "option1" => "Un programme qui convertit un langage de haut niveau en langage machine",
        "option2" => "Un programme qui convertit un langage machine en langage de haut niveau",
        "option3" => "Un programme qui exécute des tâches en arrière-plan",
        "option4" => "Un programme qui permet de créer des graphiques",
        "answer" => 1
    ),
    array(
        "question" => "Quel est le nom de l'ordinateur qui a battu le champion du monde d'échecs en 1997 ?",
        "option1" => "Deep Thought",
        "option2" => "HAL 9000",
        "option3" => "Watson",
        "option4" => "Deep Blue",
        "answer" => 4
    ),
    array(
        "question" => "Qu'est-ce qu'un logiciel libre ?",
        "option1" => "Un logiciel payant",
        "option2" => "Un logiciel propriétaire",
        "option3" => "Un logiciel gratuit",
        "option4" => "Un logiciel dont le code source est accessible et modifiable",
        "answer" => 4
    ),
    array(
        "question" => "Quel est le symbole utilisé pour les commentaires en PHP ?",
        "option1" => "//",
        "option2" => "#",
        "option3" => "--",
        "option4" => "/* */",
        "answer" => 4
    ),
    array(
        "question" => "Quel est le nom du système de gestion de base de données le plus populaire au monde ?",
        "option1" => "MySQL",
        "option2" => "Oracle",
        "option3" => "PostgreSQL",
        "option4" => "Microsoft SQL Server",
        "answer" => 1
    ),
    array(
        "question" => "Qu'est-ce qu'une variable en programmation ?",
        "option1" => "Un mot-clé réservé",
        "option2" => "Un nombre entier",
        "option3" => "Un emplacement de mémoire qui contient une valeur",
        "option4" => "Une instruction conditionnelle",
        "answer" => 3
    ),
    array(
        "question" => "Qu'est-ce qu'un bug en informatique ?",
        "option1" => "Un virus",
        "option2" => "Une panne matérielle",
        "option3" => "Une erreur de programmation",
        "option4" => "Un conflit de logiciels",
        "answer" => 3
    ),
    array(
        "question" => "Qu'est-ce que l'intelligence artificielle ?",
        "option1" => "Une technologie qui permet aux ordinateurs de penser comme des humains",
        "option2" => "Un programme qui peut résoudre n'importe quel problème",
        "option3" => "Une technique de marketing en ligne",
        "option4" => "Une méthode de cryptage de données",
        "answer" => 1
    ),
    array(
        "question" => "Qu'est-ce que le cloud computing ?",
        "option1" => "Un système de stockage de données en ligne",
        "option2" => "Une méthode de cryptage de données",
        "option3" => "Une technique de piratage informatique",
        "option4" => "Un type de processeur",
        "answer" => 1
    ),
    array(
        "question" => "Qu'est-ce que le HTML ?",
        "option1" => "Un langage de programmation",
        "option2" => "Un format de fichier",
        "option3" => "Un protocole de communication",
        "option4" => "Un langage de balisage",
        "answer" => 4
    ),
    array(
        "question" => "Qu'est-ce que le CSS ?",
        "option1" => "Un langage de programmation",
        "option2" => "Un format de fichier",
        "option3" => "Un protocole de communication",
        "option4" => "Un langage de style",
        "answer" => 4
        )
    );

// Démarrer une transaction
//$conn->begin_transaction();

// Loop through the questions array and insert each question into the database
foreach ($questions as $q) {
  // Prepare the INSERT statement for this question
  $stmt = $conn->prepare("INSERT INTO questions (question, option1, option2, option3, option4, answer) VALUES (?, ?, ?, ?, ?, ?)");
  if (!$stmt) {
    // Handle the error here
    die("Failed to prepare statement: " . $conn->error);
  }

  // Bind the values to the placeholders and execute the statement
  $stmt->bind_param("sssssi", $q['question'], $q['option1'], $q['option2'], $q['option3'], $q['option4'], $q['answer']);
  if (!$stmt->execute()) {
    // Handle the error here
    die("Failed to execute statement: " . $stmt->error);
  }
}
// Valider la transaction
//$conn->commit();

echo "Les questions ont été insérées avec succès dans la base de données.";

// Fermer la connexion
$conn->close();
?>