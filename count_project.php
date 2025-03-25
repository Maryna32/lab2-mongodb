<?php
require_once "connect.php";

if (isset($_GET['chief'])) {
    $chief = $_GET['chief'];
    
    $projects = $client->dbforlab->tasks->distinct("project", ["manager" => $chief]);
    $projectCount = count($projects);
    
    echo "<h2>Кількість проєктів керівника $chief: $projectCount</h2>";
} else {
    echo "<h2>Будь ласка, виберіть керівника</h2>";
}