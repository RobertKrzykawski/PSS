<?php if ($user): ?>
    <h1>User profile</h1>
    <p>Name: <?= htmlspecialchars($user->name) ?></p>
    <p>Surname: <?= htmlspecialchars($user->surname) ?></p>
    <p>Email: <?= htmlspecialchars($user->email) ?></p>
<?php else: ?>
    <p>User not found.</p>
<?php endif; ?>
