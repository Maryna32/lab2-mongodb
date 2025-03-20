<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lab2</title>
    <style>
      .container {
         display: flex;
         gap: 30px;
      }
      section {
        border: 1px solid black;
        padding-left: 15px;
        width: 30%;
        height: 130px;
        box-shadow: 1px 1px 1px 1px grey;
        padding-bottom: 20px;
      }

      
    </style>
  </head>
  <body>
    <h2>Варіант 2. БД для зберігання інформації про процес роботи співробітників над проектами</h2>
  
    <div class=container>
        <section>
          <h3>Інформація про виконані завдання за обраним проєктом на зазначену дату</h3>
          <form action="information_for_date.php" method="get">
            <label for="nameProject">Введіть назву проекта</label>
            <select name="nameProject" id="nameProject">
              <?php
              include("connect.php");

              $projects = $client->dbforlab->projects->find();
              foreach ($projects as $project) {
              echo "<option value='{$project['name']}'>{$project['name']}</option>";
            }
              

              ?>
            </select>
            <label for="date_project">Оберіть дату</label>
            <select name="date_project" id="date_project">
              <?php
              include("connect.php");
              $tasks = $client->dbforlab->tasks->find();
              foreach ($tasks as $task) {
  
                $endTimeFormatted = date("Y-m-d", $task['endTime']); 
                echo "<option value='{$task['endTime']}'>{$endTimeFormatted}</option>";
}
              ?>
            </select>
           <input type="submit" value="Отримати результат">
        </form>
      </section>
    
      <section>
        <h3>Загальний час роботи над обраним проєктом</h3>
        <form action="time_for_project.php" method="get">
          <label for="nameProject">Введіть назву проекта</label>
          <select name="nameProject" id="nameProject">
            <?php
            include("connect.php");
            $projects = $client->dbforlab->projects->find();
              foreach ($projects as $project) {
              echo "<option value='{$project['name']}'>{$project['name']}</option>";
            }

            ?>
          </select>
           <input type="submit" value="Отримати результат">
        </form>
      </section>
    
      <section>
      <h3>Кількість співробітників відділу обраного керівника</h3>
      <form action="count_workers.php" method="get">
          <label for="chief">Введіть ім'я керівника</label>
          <select name="chief" id="chief">
            <?php
            include("connect.php");

            $tasks = $client->dbforlab->tasks->find();
              foreach ($tasks as $task) {
  
                echo "<option value='{$task['manager']}'>{$task['manager']}</option>";
}

            ?>
          </select>
           <input type="submit" value="Отримати результат">
      </form>
      </section>
    </div>
  </body>
</html>