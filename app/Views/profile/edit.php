<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Styling here... */
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
            max-width: 800px;
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

        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            background: #ffffff80;
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffd700;
            margin-bottom: 1rem;
        }

        .profile-info {
            font-size: 1.2rem;
            color: #333;
        }

        .profile-info p {
            margin: 0.5rem 0;
        }

        .btn {
            padding: 0.7rem 2rem;
            /* Increased padding */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            /* Increased font size */
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

        .form-container {
            display: none;
            margin-top: 2rem;
        }

        .form-container.active {
            display: block;
        }

        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            /* Increased padding */
            margin-bottom: 1.5rem;
            /* Increased bottom margin */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            /* Ensures readability */
        }

        input[type="submit"] {
            background: #56ab2f;
            color: #fff;
            font-size: 1.1rem;
            /* Slightly increased font size */
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 0.7rem 2rem;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #3d8a23;
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
            <a href="/profile/edit">Profil</a>
            <a href="/auth/logout">Logout</a>
        </nav>
    </header>

    <main>
        <h1>Profil Saya</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <!-- Show Profile Section -->
        <div class="profile-card">
            <img src="<?= base_url('uploads/profile_images/' . esc($user['profile_image'] ?: 'default-profile.png')) ?>"
                alt="Foto Profil" class="profile-image">
            <div class="profile-info">
                <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
                <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            </div>
            <button class="btn btn-primary" id="editProfileBtn">Edit Profil</button>
        </div>

        <!-- Edit Profile Form -->
        <div class="form-container" id="editForm">
            <form action="/profile/edit" method="POST" enctype="multipart/form-data">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= esc($user['username']) ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= esc($user['email']) ?>" required>

                <label for="profile_image">Foto Profil</label>
                <input type="file" id="profile_image" name="profile_image">

                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password"
                    placeholder="Kosongkan jika tidak ingin mengganti password">

                <input type="submit" value="Simpan Perubahan">
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Dino Task Manager | Designed with <a href="#">Love</a></p>
    </footer>

    <script>
        // Toggle visibility of the edit form
        document.getElementById('editProfileBtn').addEventListener('click', function () {
            const editForm = document.getElementById('editForm');
            editForm.classList.toggle('active');
        });
    </script>
</body>

</html>
