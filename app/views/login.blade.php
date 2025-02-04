<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
</head>
<body>


<h1>Login</h1>
<?php if(isset($error)): ?>
    <div><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form action="/auth/login" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
<p>Don't have an account? <a href="/auth/register">Register here</a></p>





<h1>Register</h1>
<?php if(isset($errors)): ?>
    <?php foreach($errors as $error): ?>
        <div><?php echo htmlspecialchars($error); ?></div>
    <?php endforeach; ?>
<?php endif; ?>

<form action="/auth/register" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
<p>Already have an account? <a href="/auth/login">Login here</a></p>




</body>
</html>

