<?php
include("connect.php");

if (isset($_GET['chief']) && !empty($_GET['chief'])) {
    $chief = $_GET['chief'];
    $projectsCount = $client->dbforlab->projects->countDocuments(["manager" => $chief]);

    echo "<h2>Кількість проєктів керівника $chief: $projectsCount</h2>";
} else {
    echo "<h2>Будь ласка, оберіть керівника.</h2>";
}
