<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
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
            max-width: 600px;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input,
        textarea {
            padding: 0.5rem;
            margin-bottom: 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
        }

        textarea {
            resize: none;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #56ab2f;
            color: #fff;
        }

        .btn-primary:hover {
            background: #3d8a23;
        }

        .btn-secondary {
            background: #e53935;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #c53030;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .alert-danger {
            background: #e53935;
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
        <h1>Edit Tugas</h1>

        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="/tasks/update/<?= $task['id'] ?>" method="POST">
            <?= csrf_field() ?>

            <label for="title">Judul</label>
            <input type="text" id="title" name="title" value="<?= esc($task['title']) ?>" required>

            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4" required><?= esc($task['description']) ?></textarea>

            <label for="pomodoro_time">Waktu Pomodoro (menit)</label>
            <input type="number" id="pomodoro_time" name="pomodoro_time" value="<?= esc($task['pomodoro_time']) ?>"
                min="1" required>

            <div style="display: flex; justify-content: space-between;">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/tasks" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Dino Task Manager | Designed with <a href="#">Love</a></p>
    </footer>
</body>

</html>
