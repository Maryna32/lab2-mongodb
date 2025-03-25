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
        height: 230px;
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
          <form action="information_for_date.php" method="get" id="projectForm">
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
                echo "<option value='{$endTimeFormatted}'>{$endTimeFormatted}</option>";
              }
              ?>
            </select>
           <input type="submit" value="Отримати результат">
        </form>
        <div id="savedResults1"></div>
      </section>
    
      <section>
        <h3>Кількість проєктів зазначеного керівника</h3>
        <form action="count_project.php" method="get" id="chiefForm">
          <label for="chief">Введіть керівника</label>
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
        <div id="savedResults2"></div>
      </section>
    
      <section>
      <h3>Інформація про співробітників обраного керівника</h3>
      <form action="workers.php" method="get" id="workersForm">
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
      <div id="savedResults3"></div>
      </section>
    </div>
    <script>
  document.addEventListener("DOMContentLoaded", () => {
    const forms = [
      { formId: "projectForm", resultId: "savedResults1" },
      { formId: "chiefForm", resultId: "savedResults2" },
      { formId: "workersForm", resultId: "savedResults3" }
    ];

    forms.forEach(({ formId, resultId }) => {
      const form = document.getElementById(formId);
      const savedResults = document.getElementById(resultId);

      if (!form) {
        console.error(`Форма з ID ${formId} не знайдена!`);
        return;
      }

      function loadSavedData() {
        const savedDataKey = localStorage.getItem(formId);
        if (savedDataKey) {
          try {
            const parsedData = JSON.parse(savedDataKey);
            const queryParams = new URLSearchParams(parsedData).toString();
            
            savedResults.innerHTML = `
              <h4>Раніше збережені результати:</h4>
              <p>
                <a href="${form.action}?${queryParams}">
                  Переглянути попередні результати
                </a>
              </p>
            `;
          } catch {
            savedResults.innerHTML = "<p>Немає збережених даних.</p>";
          }
        } else {
          savedResults.innerHTML = "<p>Немає збережених даних.</p>";
        }
      }

      form.addEventListener("submit", (e) => {
        const formData = {};
        Array.from(form.elements)
          .filter((el) => el.tagName === "INPUT" || el.tagName === "SELECT")
          .forEach((el) => {
            if (el.value !== 'Отримати результат') {
              formData[el.name] = el.value;
            }
          });

        if (Object.keys(formData).length > 0) {
          localStorage.setItem(formId, JSON.stringify(formData));
          loadSavedData();
        } else {
          alert("Заповніть всі поля!");
          e.preventDefault(); 
        }
      });

      loadSavedData();
    });
  });
  </script>
  </body>
</html>