<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['title'] ?? 'Article Not Found'); ?></title>
</head>
<body>
    <?php if ($article): ?>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <div class="content">
            <?php echo htmlspecialchars($article['content']); ?>
        </div>
        <div >
            <p>User ID: <?php echo htmlspecialchars($article['user_id']); ?></p>
        </div>
    <?php else: ?>
        <h1>Article Not Found</h1>
    <?php endif; ?>
    
    <a href="/articles">Back to Articles List</a>
</body>
</html>