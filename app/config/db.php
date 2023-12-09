<?php
// db.php - Gestion de la connexion à la base de données

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test_hdce";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour échapper les chaînes pour les requêtes SQL
function escapeString($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}

// Fonction pour exécuter une requête SQL
function executeQuery($sql) {
    global $conn;
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Erreur dans la requête : " . $conn->error);
    }

    return $result;
}
?>
