<?php
session_start();
require_once('database.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: se_connecter.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Créer une instance de la classe Database
$db = new Database();
$userId = $_SESSION['user_id'];

// Vérifiez si le formulaire de suppression a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['liste_id'])) {
    $listeId = $_POST['liste_id'];

    // Supprimer la liste de la base de données
    $db->deleteList($userId, $listeId);

    // Rediriger vers la page des listes après suppression
    header('Location: listes.php');
    exit();
}
?>
