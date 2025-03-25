<?php
require_once "connect.php";

if (isset($_GET['chief'])) {
    $chief = $_GET['chief'];
    $cursor = $client->dbforlab->tasks->find(["manager" => $chief]);
    $employees = [];

    foreach ($cursor as $task) {
        $employees = array_merge($employees, (array)$task['employees']); 
    }

    $uniqueEmployees = array_unique($employees);

    echo "<h2>Співробітники, які працювали під керівництвом $chief:</h2>";
    echo "<ul>";
    foreach ($uniqueEmployees as $employee) {
        echo "<li>$employee</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>Будь ласка, виберіть керівника</h2>";
}
