<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>body{font-family:Arial,sans-serif;background:#f1f5f9;margin:40px}.card{background:#fff;max-width:420px;margin:auto;padding:24px;border-radius:8px;box-shadow:0 2px 8px #0002}label{display:block;margin-top:14px;font-weight:bold}input{box-sizing:border-box;width:100%;padding:10px;margin-top:6px}button{margin-top:20px;padding:10px 16px;background:#2563eb;color:#fff;border:0;border-radius:4px;cursor:pointer}.error{color:#b91c1c}.success{color:#166534}</style>
</head>
<body>
<div class="card">
    <h1>Log In</h1>
    <?php if ($message = session()->getFlashdata('error')): ?><p class="error"><?= esc($message) ?></p><?php endif; ?>
    <?php if ($message = session()->getFlashdata('success')): ?><p class="success"><?= esc($message) ?></p><?php endif; ?>
    <?php if ($errors = session()->getFlashdata('errors')): ?><div class="error"><?php foreach ($errors as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?></div><?php endif; ?>
    <form method="post" action="<?= site_url('login') ?>">
        <label for="username">Username</label>
        <input id="username" name="username" value="<?= esc(old('username')) ?>" required>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        <button type="submit">Log In</button>
    </form>
    <p><a href="<?= site_url('/') ?>">Return to tasks</a></p>
</div>
</body>
</html>
