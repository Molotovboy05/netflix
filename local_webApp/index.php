<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        :root {
            --tg-theme-bg-color: #000000;
            --tg-theme-text-color: #ffffff;
            --tg-theme-hint-color: #a0a0a0;
            --tg-theme-link-color: #3498db;
            --tg-theme-button-color: #3498db;
            --tg-theme-button-text-color: #ffffff;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--tg-theme-bg-color);
            color: var(--tg-theme-text-color);
        }

        .container {
            padding: 20px;
            padding-bottom: 60px;
        }

        h1 {
            text-align: center;
            color: var(--tg-theme-link-color);
        }

        #task-form {
            display: flex;
            margin-bottom: 20px;
        }

        #task-input {
            flex-grow: 1;
            padding: 10px;
            font-size: 16px;
            background-color: #1a1a1a;
            color: var(--tg-theme-text-color);
            border: 1px solid var(--tg-theme-button-color);
            border-radius: 4px 0 0 4px;
        }

        #add-task {
            padding: 10px 20px;
            font-size: 16px;
            background-color: var(--tg-theme-button-color);
            color: var(--tg-theme-button-text-color);
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #1a1a1a;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .task-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .task-item.completed span {
            text-decoration: line-through;
            color: var(--tg-theme-hint-color);
        }

        .nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #1a1a1a;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }

        .nav-button {
            background-color: transparent;
            border: none;
            color: var(--tg-theme-link-color);
            font-size: 14px;
            cursor: pointer;
        }

        .settings-option {
            margin-bottom: 20px;
        }

        .settings-option label {
            display: block;
            margin-bottom: 5px;
            color: var(--tg-theme-link-color);
        }

        .settings-option select {
            width: 100%;
            padding: 10px;
            background-color: #1a1a1a;
            color: var(--tg-theme-text-color);
            border: 1px solid var(--tg-theme-button-color);
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Active Tasks Page -->
        <div id="active-tasks" class="container">
            <h1>Active Tasks</h1>
            <form id="task-form">
                <input type="text" id="task-input" placeholder="Enter a new task" required>
                <button type="submit" id="add-task">Add</button>
            </form>
            <ul id="active-task-list" class="task-list"></ul>
        </div>

        <!-- Completed Tasks Page -->
        <div id="completed-tasks" class="container" style="display: none;">
            <h1>Completed Tasks</h1>
            <ul id="completed-task-list" class="task-list"></ul>
        </div>

        <!-- Settings Page -->
        <div id="settings" class="container" style="display: none;">
            <h1>Settings</h1>
            <div class="settings-option">
                <label for="sort-order">Sort Tasks By:</label>
                <select id="sort-order">
                    <option value="added">Date Added</option>
                    <option value="alphabetical">Alphabetical</option>
                </select>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="nav">
            <button class="nav-button" onclick="showPage('active-tasks')">Active</button>
            <button class="nav-button" onclick="showPage('completed-tasks')">Completed</button>
            <button class="nav-button" onclick="showPage('settings')">Settings</button>
        </nav>
    </div>

    <script>
        function createMockTelegramWebApp() {
    return {
        initDataUnsafe: {
            user: { id: 123, first_name: 'Test', username: 'testuser' },
            chat: { id: 456, type: 'private' }
        },
        showAlert: (message) => console.log('Alert:', message),
        showConfirm: (message, callback) => {
            console.log('Confirm:', message);
            callback(true); // Simule toujours une confirmation positive
        },
        // Ajoutez d'autres méthodes selon vos besoins
    };
}

// Utilisation
if (!window.Telegram) {
    window.Telegram = { WebApp: createMockTelegramWebApp() };
}

const tg = window.Telegram.WebApp;
     //   let tg = window.Telegram.WebApp;
        tg.expand();

        const taskForm = document.getElementById('task-form');
        const taskInput = document.getElementById('task-input');
        const activeTaskList = document.getElementById('active-task-list');
        const completedTaskList = document.getElementById('completed-task-list');
        const sortOrder = document.getElementById('sort-order');

        let tasks = {
            active: [],
            completed: []
        };

        taskForm.addEventListener('submit', function(e) {
            e.preventDefault();
            addTask(taskInput.value);
            taskInput.value = '';
        });

        function addTask(text) {
            const task = { id: Date.now(), text: text };
            tasks.active.push(task);
            renderTasks();
        }

        function createTaskElement(task, isCompleted) {
            const li = document.createElement('li');
            li.className = 'task-item';
            li.innerHTML = `
                <input type="checkbox" ${isCompleted ? 'checked' : ''}>
                <span>${task.text}</span>
            `;
            li.querySelector('input').addEventListener('change', function() {
                toggleTaskCompletion(task.id);
            });
            return li;
        }

        function toggleTaskCompletion(taskId) {
            const activeIndex = tasks.active.findIndex(t => t.id === taskId);
            const completedIndex = tasks.completed.findIndex(t => t.id === taskId);

            if (activeIndex !== -1) {
                const [task] = tasks.active.splice(activeIndex, 1);
                tasks.completed.push(task);
            } else if (completedIndex !== -1) {
                const [task] = tasks.completed.splice(completedIndex, 1);
                tasks.active.push(task);
            }

            renderTasks();
        }

        function renderTasks() {
            activeTaskList.innerHTML = '';
            completedTaskList.innerHTML = '';

            const sortedActiveTasks = sortTasks(tasks.active);
            const sortedCompletedTasks = sortTasks(tasks.completed);

            sortedActiveTasks.forEach(task => {
                activeTaskList.appendChild(createTaskElement(task, false));
            });

            sortedCompletedTasks.forEach(task => {
                completedTaskList.appendChild(createTaskElement(task, true));
            });
        }

        function sortTasks(taskList) {
            const order = sortOrder.value;
            return [...taskList].sort((a, b) => {
                if (order === 'alphabetical') {
                    return a.text.localeCompare(b.text);
                } else {
                    return a.id - b.id;
                }
            });
        }

        function showPage(pageId) {
            document.querySelectorAll('.container').forEach(container => {
                container.style.display = 'none';
            });
            document.getElementById(pageId).style.display = 'block';
        }

        sortOrder.addEventListener('change', renderTasks);

        // Initial render
        renderTasks();

        // Notify Telegram that the web app is ready
        tg.ready();
    </script>
</body>
</html>