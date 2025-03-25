<?php
include("connect.php");

if (isset($_GET['nameProject']) && isset($_GET['date_project'])) {
    $project = $_GET['nameProject'];
    $selectedDate = $_GET['date_project'];

    // Перевіряємо формат дати
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
        echo "<p>Некоректний формат дати. Використовуйте формат РРРР-ММ-ДД.</p>";
        exit();
    }

    $startOfDay = strtotime($selectedDate . " 00:00:00");
    $endOfDay = strtotime($selectedDate . " 23:59:59");

    $tasks = $client->dbforlab->tasks->find([
        'project' => $project,
        'endTime' => ['$gte' => $startOfDay, '$lt' => $endOfDay]
    ]);

    echo "<h2>Виконані завдання для проєкту: $project на дату $selectedDate</h2>";

    $foundTasks = false;
    foreach ($tasks as $task) {
        $foundTasks = true;
        echo "<h3>{$task['title']}</h3>";
        echo "<p><strong>Опис:</strong> {$task['description']}</p>";
        echo "<p><strong>Співробітники:</strong> " . implode(", ", (array)$task['employees']) . "</p>";
    }

    if (!$foundTasks) {
        echo "<p>Немає завдань на цю дату.</p>";
    }
} else {
    echo "<p>Будь ласка, виберіть проєкт і дату.</p>";
}
?>