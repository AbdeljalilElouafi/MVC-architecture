<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
</head>
<body>
    <h1>Articles</h1>
    

    <a href="/articles/create" class="button">Create New Article</a>
    
    <ul>
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <li>

                <a href="/articles/show/<?php echo $article['id']; ?>">
                    <?php echo htmlspecialchars($article['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No articles available.</p>
    <?php endif; ?>
    </ul>
    <a href="/auth/login" class="button">Login</a>

</body>
</html>