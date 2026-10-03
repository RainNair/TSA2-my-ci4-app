<?= $this->include('TS2/header') ?>

<h2><?= esc($page_title) ?></h2>
<?php if ($errors = session()->getFlashdata('errors')): ?>
    <div class="error"><?php foreach ($errors as $error): ?><p><?= esc($error) ?></p><?php endforeach; ?></div>
<?php endif; ?>
<div class="card">
    <form method="post" action="<?= esc($action) ?>">
        <label for="title">Title *</label><br>
        <input id="title" name="title" maxlength="150" required style="width:100%;padding:8px" value="<?= esc(old('title', $task['title'] ?? '')) ?>"><br><br>
        <label for="task_date">Task date *</label><br>
        <input id="task_date" type="date" name="task_date" required style="padding:8px" value="<?= esc(old('task_date', $task['task_date'] ?? '')) ?>"><br><br>
        <label for="status">Status</label><br>
        <select id="status" name="status" style="padding:8px">
            <?php $currentStatus = old('status', $task['status'] ?? 'pending'); ?>
            <?php foreach (['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'] as $value => $label): ?>
                <option value="<?= $value ?>" <?= $currentStatus === $value ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Save Task</button>
        <a href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
</div>
</body>
</html>
