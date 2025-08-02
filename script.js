const quotes = [
  "Push yourself, because no one else is going to do it for you.",
  "Do something today that your future self will thank you for.",
  "The secret of getting ahead is getting started.",
  "Success doesn't come to you. You go to it.",
  "Start now. Not tomorrow. Not later."
];
document.getElementById("quote").innerText = quotes[Math.floor(Math.random() * quotes.length)];

let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
let history = JSON.parse(localStorage.getItem("history")) || [];

function toggleDarkMode() {
  document.body.classList.toggle("dark-mode");
}

function getLoggedInUser() {
  return localStorage.getItem("taskSparkUser") || "Guest";
}

function logoutUser() {
  localStorage.removeItem("taskSparkUser");
  alert("👋 You’ve been logged out!");
  location.reload();
}

function loadUserProfile() {
  const name = getLoggedInUser();
  document.getElementById("profileName").innerText = `👤 ${name}`;
  document.getElementById("mainProfileName").innerText = name;
}

function saveTasks() {
  localStorage.setItem("tasks", JSON.stringify(tasks));
  localStorage.setItem("history", JSON.stringify(history));
  renderTasks();
}

function addTask() {
  const text = document.getElementById("taskInput").value.trim();
  const time = document.getElementById("reminderTime").value;
  if (!text) return alert("Please enter a task.");
  tasks.push({ text, time, done: false, completedDate: null });
  document.getElementById("taskInput").value = "";
  document.getElementById("reminderTime").value = "";
  saveTasks();
  setReminder(text, time);
}

function renderTasks() {
  const list = document.getElementById("taskList");
  list.innerHTML = "";
  tasks.forEach((task, index) => {
    const li = document.createElement("li");
    if (task.done) li.classList.add("done");

    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.checked = task.done;
    checkbox.onchange = () => toggleDone(index);

    const textSpan = document.createElement("span");
    textSpan.innerText = task.text;

    const countdown = document.createElement("small");
    countdown.id = `countdown-${index}`;

    if (!task.done && task.time) {
      updateCountdown(countdown, task.time, index);
      task.countdownInterval = setInterval(() => {
        updateCountdown(countdown, task.time, index);
      }, 1000);
    }

    const deleteBtn = document.createElement("button");
    deleteBtn.className = "delete-btn";
    deleteBtn.innerHTML = "🗑️";
    deleteBtn.onclick = () => deleteTask(index);

    li.appendChild(checkbox);
    li.appendChild(textSpan);
    li.appendChild(countdown);
    li.appendChild(deleteBtn);
    list.appendChild(li);
  });
}

function updateCountdown(countdownElement, timeStr, index) {
  const now = new Date();
  const [hours, minutes] = timeStr.split(":");
  const target = new Date();
  target.setHours(hours, minutes, 0, 0);
  const diff = target - now;

  if (diff <= 0) {
    countdownElement.innerText = "⏰ Time’s up!";
    clearInterval(tasks[index].countdownInterval);
    return;
  }

  const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
  const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
  const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
  countdownElement.innerText = `⏳ ${h}:${m}:${s} left`;
}

function toggleDone(index) {
  const task = tasks[index];
  task.done = !task.done;
  task.completedDate = task.done ? new Date().toISOString() : null;
  if (task.done) {
    history.push({ ...task });
    alert("✅ Task completed!");
  }
  saveTasks();
}

function deleteTask(index) {
  const task = tasks[index];
  if (task.done && task.completedDate) history.push(task);
  tasks.splice(index, 1);
  saveTasks();
}

function setReminder(taskText, timeStr) {
  if (!timeStr) return;
  const now = new Date();
  const [hours, minutes] = timeStr.split(":");
  const reminderTime = new Date();
  reminderTime.setHours(hours, minutes, 0, 0);
  const delay = reminderTime - now;
  if (delay > 0) {
    setTimeout(() => {
      alert(`⏰ Reminder: ${taskText}`);
    }, delay);
  }
}

function toggleBot() {
  alert("🤖 Bot coming soon!");
}

function testNotification() {
  alert("🔔 This is a test notification!");
}

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const main = document.querySelector('.main');
  const toggle = document.getElementById('sidebarToggle');

  sidebar.classList.toggle('open');
  main.classList.toggle('sidebar-open');

  // NEW:
  document.body.classList.toggle('sidebar-open');

  if (sidebar.classList.contains('open')) {
    toggle.style.left = '260px';
  } else {
    toggle.style.left = '18px';
  }
}

function isOverdue(timeStr) {
  const now = new Date();
  const [hours, minutes] = timeStr.split(":");
  const target = new Date();
  target.setHours(hours, minutes, 0, 0);
  return target < now;
}

window.onload = () => {
  if (!localStorage.getItem("taskSparkUser")) {
    localStorage.setItem("taskSparkUser", "Tharshini");
  }

  loadUserProfile();
  renderTasks();

  tasks.forEach(t => {
    if (!t.done && t.time && isOverdue(t.time)) {
      alert(`⏰ Overdue: ${t.text}`);
    }
  });
};
