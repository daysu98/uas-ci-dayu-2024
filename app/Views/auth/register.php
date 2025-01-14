<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <!-- CSS Langsung di Dalam HTML -->
    <style>
        /* Styling Body */
        body {
            background-color: #212121;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #ffffff;
        }

        /* Container Utama */
        .container {
            max-width: 900px;
            margin: 50px auto;
            display: flex;
            background-color: #2b2b2b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Bagian Kiri: Gambar */
        .left-section {
            flex: 1;
            text-align: center;
        }

        .left-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Bagian Kanan: Formulir */
        .right-section {
            flex: 1;
            padding: 30px;
        }

        .right-section h2 {
            margin-bottom: 20px;
            color: #4caf50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #bdbdbd;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            background-color: #3b3b3b;
            color: #fff;
            border: 1px solid #555;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Tombol Submit */
        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Styling Alert */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #d9534f;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Container -->
    <div class="container">
        <!-- Bagian Kiri -->
        <div class="left-section">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                alt="Sign-Up Image">
        </div>

        <!-- Bagian Kanan -->
        <div class="right-section">
            <h2>Register</h2>

            <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>

            <!-- Formulir -->
            <form action="/register-post" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?= old('username') ?>"
                        placeholder="Enter your username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= old('email') ?>"
                        placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                </div>

                <!-- Tombol Submit -->
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
