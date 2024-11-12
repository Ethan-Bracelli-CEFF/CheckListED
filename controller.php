<?php
require_once('./database.php');

$db = new Database();
$user = $_SESSION['user'];


function getAllChecklist(){
    global $db;
    global $user;

    return $db->getLists($user);
}


function getUser($userId) {
    global $db;

    return $db->getUser($userId);
}

function getAllTasks($listId){
    global $db;

    return $$db->getAllTasks($listId);
}