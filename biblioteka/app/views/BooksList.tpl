<h1>Books list</h1>
<ul>
    <?php foreach ($books as $book): ?>
        <li><?= htmlspecialchars($book->title) ?> - <?= htmlspecialchars($book->author) ?> (<?= htmlspecialchars($book->isbn) ?>)</li>
    <?php endforeach; ?>
</ul>
