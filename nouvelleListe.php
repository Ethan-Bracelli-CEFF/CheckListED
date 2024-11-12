<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: se_connecter.php');
    exit();
}

$db = new Database();
$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $db->createList($titre, $description, $userId);

    header('Location: listes.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Créer une nouvelle liste</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="/checkListED.css" rel="stylesheet" />
</head>
<body class="bg-color">
<?php require_once('header.php'); ?>
    <main class="container mt-5">
        <h1 class="fw-bold text-center" style="color: #EBD3F8;">Créer une Nouvelle Liste</h1>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <!-- Formulaire pour créer une nouvelle liste -->
                <form action="nouvelleListe.php" method="post">
                    <div class="mb-3">
                        <label for="titre" class="form-label label">Titre de la liste</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label label">Description de la liste</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/listes.php" class="btn fw-bold bouton-violet" style="display: flex; align-items: center; justify-content: center;">Retour</a>
                        <button type="submit" class="btn fw-bold bouton-violet">Créer</button>  
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
