<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('links/links.php'); ?>
    <style>
        div.login-form{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-none">
        <form method="POST" action="<?= base_url('admin') ?>">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger"><?= session('error') ?></div>
                <?php endif; ?>
                <div class="mb-3">
                   <input type="text" name="admin_name" required class="form-control shadow-none text-center" placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input type="password" name="admin_pass" required class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>
</body>
</html>
