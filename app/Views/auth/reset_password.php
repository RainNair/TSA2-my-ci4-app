<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>body{font-family:Arial,sans-serif;background:#f1f5f9;margin:40px}.card{background:#fff;max-width:420px;margin:auto;padding:24px;border-radius:8px;box-shadow:0 2px 8px #0002}label{display:block;margin-top:14px;font-weight:bold}input{box-sizing:border-box;width:100%;padding:10px;margin-top:6px}button{margin-top:20px;padding:10px 16px;background:#2563eb;color:#fff;border:0;border-radius:4px;cursor:pointer}.error{color:#b91c1c}</style>
</head>
<body>
<div class="card">
    <h1>Demo Password Reset</h1>
    <p>This resets the selected account password to <strong>password</strong>.</p>
    <?php if ($message = session()->getFlashdata('error')): ?><p class="error"><?= esc($message) ?></p><?php endif; ?>
    <form method="post" action="<?= site_url('reset-password') ?>">
        <label for="username">Username</label>
        <input id="username" name="username" value="<?= esc(old('username')) ?>" required>
        <button type="submit">Reset Password</button>
    </form>
    <p><a href="<?= site_url('login') ?>">Return to login</a></p>
</div>
</body>
</html>
