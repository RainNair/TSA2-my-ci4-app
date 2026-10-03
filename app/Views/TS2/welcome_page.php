<?= $this->include('TS2/header') ?>

<h2><?= esc($page_title) ?></h2>
<p><strong>Today's Date:</strong> <?= esc($today) ?></p>

<?php if (!empty($tasks)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task Title</th>
                <th>Status</th>
            <th>Task Date</th>
            <?php if (session()->get('logged_in')): ?><th>Actions</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['id']) ?></td>
                    <td><?= esc($task['title']) ?></td>
                    <td><span class="status <?= esc($task['status']) ?>"><?= esc(str_replace('_', ' ', $task['status'])) ?></span></td>
                    <td><?= esc($task['task_date']) ?></td>
                    <?php if (session()->get('logged_in')): ?>
                        <td><a href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>">Edit</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No tasks scheduled for today!</p>
<?php endif; ?>

</body>
</html>
