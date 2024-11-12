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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_liste'])) {
    $listeId = $_POST['id_liste'];
    $listName = $db->getListName($listeId);
    $file = $listName.'.php';
    $_SESSION['id_liste'] = $listeId;

    $current = file_get_contents($file);

    $current.= "";

    header('Location: Liste.php');
    exit();
}
?>