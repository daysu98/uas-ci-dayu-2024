<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - Dino Theme</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Fredoka', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #a8e063, #56ab2f);
            color: #fff;
            overflow-x: hidden;
        }

        header {
            background: #4caf50;
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 1rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ffd700;
        }

        main {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff30;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #ffd700;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #56ab2f;
            color: #fff;
        }

        .btn-primary:hover {
            background: #3d8a23;
        }

        .btn-success {
            background: #4caf50;
            color: #fff;
        }

        .btn-success:hover {
            background: #388e3c;
        }

        .btn-danger {
            background: #e53935;
            color: #fff;
        }

        .btn-danger:hover {
            background: #b71c1c;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .alert-success {
            background: #4caf50;
        }

        .task-list {
            margin-top: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .task-item {
            padding: 1.5rem;
            background: #ffffff80;
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .task-item h3 {
            margin: 0;
            font-weight: 700;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-item h3 a {
            text-decoration: none;
            color: #56ab2f;
            font-size: 1.2rem;
            margin-left: 0.5rem;
            transition: color 0.3s ease;
        }

        .task-item h3 a:hover {
            color: #3d8a23;
        }

        .task-item p {
            margin: 0.5rem 0;
            color: #555;
        }

        .task-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .timer-display {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0.5rem 0;
            color: #333;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #4caf50;
            color: #fff;
            margin-top: 2rem;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="/tasks">Daftar Tugas</a>
            <a href="/profile/edit">Profile</a>
            <a href="/auth/logout">Logout</a>
        </nav>
    </header>

    <main>
        <h1>Dino To-Do List</h1>
        <a href="/tasks/add" class="btn btn-primary">Tambah Tugas</a>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="task-list">
            <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
            <div class="task-item">
                <h3>
                    <?= esc($task['title']) ?>
                    <a href="/tasks/edit/<?= $task['id'] ?>" title="Edit Tugas">✎</a>
                </h3>
                <p><?= esc($task['description']) ?></p>
                <p>Status: <span
                        id="status-<?= $task['id'] ?>"><?= $task['is_completed'] ? 'Selesai' : 'Pending' ?></span></p>

                <!-- Editable Pomodoro Time Field -->
                <p>Waktu:
                    <input type="number" id="pomodoro-time-<?= $task['id'] ?>" value="<?= $task['pomodoro_time'] ?>"
                        min="1" style="width: 60px;" onchange="updateTimer(<?= $task['id'] ?>)"> menit
                </p>

                <!-- Timer Display -->
                <div class="timer-display" id="timer-<?= $task['id'] ?>"><?= esc($task['pomodoro_time']) ?>:00</div>

                <div class="task-actions">
                    <button onclick="startTimer(<?= $task['id'] ?>)" class="btn btn-success">Mulai</button>
                    <button onclick="resetTimer(<?= $task['id'] ?>)" class="btn btn-danger">Reset</button>
                    <a href="/tasks/delete/<?= $task['id'] ?>" class="btn btn-danger">Hapus</a>
                    <button onclick="markAsCompleted(<?= $task['id'] ?>)" class="btn btn-success">Selesai</button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="text-align: center;">Tidak ada tugas.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Dino Task Manager | Designed with <a href="#">Love</a></p>
    </footer>

    <script>
        // Global variable to keep track of active timers
        let timers = {};

        // Function to start the Pomodoro timer
        function startTimer(taskId) {
            const timerElement = document.getElementById('timer-' + taskId);
            const pomodoroTime = document.getElementById('pomodoro-time-' + taskId)
            .value; // Get the updated time from the input
            const initialTime = pomodoroTime * 60; // Convert minutes to seconds
            let remainingTime = initialTime;

            // Display the initial timer
            timerElement.textContent = formatTime(remainingTime);

            // Start the countdown
            const interval = setInterval(() => {
                remainingTime--;

                // Update the timer display
                timerElement.textContent = formatTime(remainingTime);

                if (remainingTime <= 0) {
                    clearInterval(interval);
                    alert("Pomodoro selesai!");
                }
            }, 1000);

            // Store the interval so it can be cleared later
            timers['timer-' + taskId] = interval;
        }

        // Function to reset the Pomodoro timer
        function resetTimer(taskId) {
            const pomodoroTime = document.getElementById('pomodoro-time-' + taskId).value;
            // Clear any existing timer
            clearInterval(timers['timer-' + taskId]);

            // Reset the timer display to the original time
            const timerElement = document.getElementById('timer-' + taskId);
            timerElement.textContent = formatTime(pomodoroTime * 60);
        }

        // Function to format time in mm:ss format
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        // Function to update the timer display when the time is edited
        function updateTimer(taskId) {
            const pomodoroTime = document.getElementById('pomodoro-time-' + taskId).value;
            const timerElement = document.getElementById('timer-' + taskId);
            timerElement.textContent = formatTime(pomodoroTime * 60); // Update the timer display with the new time
        }

        // Function to mark task as completed
        function markAsCompleted(taskId) {
            const statusElement = document.getElementById('status-' + taskId);
            statusElement.textContent = 'Selesai'; // Update the status text
            statusElement.style.color = 'green'; // Optionally change color to green
        }
    </script>
</body>

</html>
