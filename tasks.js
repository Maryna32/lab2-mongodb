db.tasks.insertMany([
  {
    project: "CRM System",
    title: "Дизайн інтерфейсу",
    description: "Розробити макети сторінок",
    employees: ["Іван Коваленко", "Олена Дмитренко"],
    manager: "Олександр Іванов",
    startTime: Math.floor(new Date("2025-03-01T09:00:00Z").getTime() / 1000),
    endTime: Math.floor(new Date("2025-03-03T17:00:00Z").getTime() / 1000),
  },
  {
    project: "E-commerce Platform",
    title: "API для платежів",
    description: "Інтеграція платіжних систем",
    employees: ["Петро Лисенко"],
    manager: "Марія Петрова",
    startTime: Math.floor(new Date("2025-03-04T10:00:00Z").getTime() / 1000),
    endTime: Math.floor(new Date("2025-03-06T16:00:00Z").getTime() / 1000),
  },
  {
    project: "Mobile App",
    title: "Бекенд сервер",
    description: "Розробка серверної частини додатку",
    employees: ["Оксана Терещенко", "Ігор Бойко"],
    manager: "Анна Сидоренко",
    startTime: Math.floor(new Date("2025-03-02T08:00:00Z").getTime() / 1000),
    endTime: Math.floor(new Date("2025-03-05T18:00:00Z").getTime() / 1000),
  },
]);
