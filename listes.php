<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: se_connecter.php');
    exit();
}

// Créer une instance de la classe Database
$db = new Database();
$userId = $_SESSION['user_id'];

// Obtenez les listes de l'utilisateur
$lists = $db->getLists($userId);
?>

<!doctype html>
<html lang="en">

<head>
    <title>CheckListED</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link href="/checkListED.css" rel="stylesheet" />
</head>

<body class="bg-color">
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <?php require_once('header.php'); ?>

        <h2 class="fw-bold titre-contenu">Vos Listes</h2>
        <div class="row mt-5 rounded-5 fond-liste">
            <?php
            if (count($lists) > 0) {
                foreach ($lists as $row) { ?>
                    <div class="col-2 m-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row["nom_liste"]) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row["description_liste"]) ?></p>

                                <!-- Conteneur flex pour les deux boutons -->
                                <div class="d-flex justify-content-between">
                                    <form action="ouvrirListe.php" method="post">
                                        <input type="hidden" name="id_liste" value=<?= htmlspecialchars($row["id_liste"]) ?>>
                                        <button class="btn btn-success" style="height: 40px;" type="submit">Ouvrir</button>
                                    </form>

                                    <!-- Formulaire de suppression -->
                                    <form method="post" action="supprimerListe.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette liste ?')">
                                        <input type="hidden" name="liste_id" value="<?= htmlspecialchars($row['id_liste']) ?>">
                                        <button type="submit" name="supprimer" class="btn btn-danger" style="height: 40px;">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucune liste trouvée.</p>";
            }
                    ?>

                </div>
                <div class="col-12 m-3">
                        <form action="nouvelleListe.php" method="post" class="d-flex justify-content-center">
                            <a href="/nouvelleListe.php" class="btn rounded-5 fw-bold Shadow-lg py-4 bouton-violet" style="width: 210px;">Ajouter une liste</a>
                        </form>
                    </div>
            
        </main>
        
        <footer>
            <!-- place footer here -->
        </footer>
        
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>