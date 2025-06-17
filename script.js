const taskModal = document.getElementById("taskModal");

function openModal() {
  taskModal.style.display = "block";
}

function closeModal() {
  taskModal.style.display = "none";
}

function createTask() {
  const task = {
    title: document.getElementById("title").value,
    description: document.getElementById("description").value,
    deadline: document.getElementById("deadline").value,
    status: document.getElementById("status").value,
    priority: document.getElementById("priority").value,
  };

  fetch("../backend/task_add.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(task)
  }).then(() => {
    closeModal();
    fetchTasks();
  });
}

function fetchTasks() {
  fetch("../backend/task_get.php")
    .then(res => res.json())
    .then(data => {
      const list = document.getElementById("taskList");
      list.innerHTML = "";
      data.forEach(task => {
        list.innerHTML += `<div class="task">
          <h3>${task.title}</h3>
          <p>${task.description}</p>
          <small>${task.deadline} | ${task.status} | ${task.priority}</small>
        </div>`;
      });
    });
}

window.onload = fetchTasks;
