<?php
session_start();
require_once('database.php');

$db = new Database();
$userId = $_SESSION['user_id'];
$listeId = $_SESSION['id_liste'];

$listeName = $db->getListName($listeId);
$lists = $db->getLists($userId);
$taches = $db->getAllTasks($listeId);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkedTask = $db->getCheckedTasks($listeId);
    foreach ($checkedTask as $task) {
        $db->deleteTask($task['id_tache']);
    }

    header('Location: Liste.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>CheckListED</title>
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
    <script src="script.js"></script>
</head>

<body class="bg-color">
    <header>
        <?php require_once('header.php'); ?>
    </header>
    <h2 class="fw-bold titre-contenu">Vos Tâches pour la liste "<?php echo ($listeName) ?>"</h2>
    <div class="row mt-5 rounded-5 fond-liste">
        <?php if (count($taches) > 0): ?>
            <?php foreach ($taches as $row): ?>
                <?php
                // Détermine la classe en fonction de l'état de la tâche
                $class = ($row['isChecked_tache'] == 1) ? 'checked' : 'unchecked';
                ?>
                <div class="row" onclick="SaveCheck(<?= htmlspecialchars($row['id_tache']) ?>)">
                    <div class="col-1">
                        <div class="rounded-4 border-3 me-1 chk-box <?= $class ?>" id="<?= htmlspecialchars($row['id_tache']) ?>"></div>
                    </div>
                    <div class="col">
                        <div class="chk-text"><?= htmlspecialchars($row['contenu_tache']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="rounded-5" style="background:#EBD3F8">Aucune tâche trouvée.</p>
        <?php endif; ?>
    </div>

    </div>


    <div class="row m-3">
        <form action="liste.php" method="post" class="col-4 d-flex justify-content-center">
            <button type="submit" name="delete_checked" class="btn rounded-5 fw-bold Shadow-lg py-4 bouton-violet" style="width: 240px;">Supprimer les tâches checkées</button>
        </form>
        <form action="nouvelleTache.php" method="post" class="col-4 d-flex justify-content-center">
            <a href="/nouvelleTache.php" class="btn rounded-5 fw-bold Shadow-lg py-4 bouton-violet" style="width: 210px;">Ajouter une tâche</a>
        </form>
        <div class="col-4 d-flex justify-content-center">
            <a href="listes.php" class="btn rounded-5 fw-bold Shadow-lg py-4 text-decoration-none bouton-violet">Retour aux listes</a>
        </div>
    </div>
    <div id="check" style="display: none;">

    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>