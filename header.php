<div class="row mt-3 mx-3 ">
    <div class="col-6">
        <h1 class="fw-bold text-start CLED-titre">CheckListED</h1>
    </div>

    <div class="col">
        <a href="/utilisateur.php" class="text-decoration-none">
            <h1 class="fw-bold text-end big-username"><?php echo ($_SESSION['username']); ?></h1>
        </a>
    </div>
    <div class="col-1 d-flex justify-content-end">
        <a href="/utilisateur.php"><img src="/photo-avatar-profil.png" class="rounded-5" style="width: 120px; height: 120px"></a>
    </div>
</div>