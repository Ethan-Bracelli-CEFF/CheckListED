<?php
require_once('database.php');

$db = new Database();

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    
    $state = $db->getTaskState($taskId);
    
    if ($state === 0) {
        $db->trueTask($taskId);
        echo "Tâche complétée.";
    } elseif ($state === 1) {
        $db->falseTask($taskId);
        echo "Tâche non complétée.";
    }
}
?>
