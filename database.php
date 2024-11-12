<?php

class Database{

    private PDO $db;
    private string $hostname = "localhost";
    private string $port = "3306";
    private string $dbname = "checklisted";
    private string $username = "root";
    private string $pwd = "";
    
    public function __construct(){
        $this->db = new PDO("mysql:host=$this->hostname;port=$this->port;dbname=$this->dbname", $this->username, $this->pwd);
    }

    // Utilisation de requêtes préparées pour toutes les méthodes

    public function createUser($userName, $password) {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (username, password_utilisateur) VALUES (:username, :password)");
        $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByCredentials($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE username = :username AND password_utilisateur = :password");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId){
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateUser($userId, $userName, $password) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET username = :username, password_utilisateur = :password WHERE id_utilisateur = :userId");
        $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function changeUsernameUser($userId, $newUsername){
        $stmt = $this->db->prepare("UPDATE utilisateurs SET username = :newUsername WHERE id_utilisateur = :userId");
        $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function changePasswordUser($userId, $newPassword){
        $stmt = $this->db->prepare("UPDATE utilisateurs SET password_utilisateur = :newPassword WHERE id_utilisateur = :userId");
        $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getLists($userId){
        $stmt = $this->db->prepare("SELECT * FROM listes WHERE utilisateurs_id_utilisateur = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListName($listeId){
        $stmt = $this->db->prepare("SELECT nom_liste FROM listes WHERE id_liste = :listeId");
        $stmt->bindParam(':listeId', $listeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['nom_liste'];
    }

    public function deleteList($userId, $listId){
        $stmt = $this->db->prepare("DELETE FROM listes WHERE id_liste = :listId AND utilisateurs_id_utilisateur = :userId");
        $stmt->bindParam(':listId', $listId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function createList($nom_liste, $description_liste, $userId){
        $stmt = $this->db->prepare("INSERT INTO listes (nom_liste, description_liste, utilisateurs_id_utilisateur) VALUES (:nom_liste, :description_liste, :userId)");
        $stmt->bindParam(':nom_liste', $nom_liste, PDO::PARAM_STR);
        $stmt->bindParam(':description_liste', $description_liste, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllTasks($listId){
        $stmt = $this->db->prepare("SELECT * FROM taches WHERE listes_id_liste = :listId");
        $stmt->bindParam(':listId', $listId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCheckedTasks($listId){
        $stmt = $this->db->prepare("SELECT * FROM taches WHERE listes_id_liste = :listId AND isChecked_tache = 1");
        $stmt->bindParam(':listId', $listId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour obtenir l'état de la tâche
    public function getTaskState($taskId) {
        $stmt = $this->db->prepare("SELECT isChecked_tache FROM taches WHERE id_tache = :taskId");
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['isChecked_tache'];
    }

    public function deleteTask($taskId){
        $stmt = $this->db->prepare("DELETE FROM taches WHERE id_tache = :taskId");
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function createTask($contenu_tache, $listId){
        $stmt = $this->db->prepare("INSERT INTO taches (contenu_tache, listes_id_liste, isChecked_tache) VALUES (:contenu_tache, :listId, 'False')");
        $stmt->bindParam(':contenu_tache', $contenu_tache, PDO::PARAM_STR);
        $stmt->bindParam(':listId', $listId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function trueTask($taskId) {
        $stmt = $this->db->prepare("UPDATE taches SET isChecked_tache = true WHERE id_tache = :taskId");
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function falseTask($taskId) {
        $stmt = $this->db->prepare("UPDATE taches SET isChecked_tache = false WHERE id_tache = :taskId");
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
