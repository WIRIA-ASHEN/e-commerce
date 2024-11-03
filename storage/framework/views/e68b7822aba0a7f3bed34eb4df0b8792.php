<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="<?php echo e(route('login')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>
<?php /**PATH C:\laragon\www\e-commerce\resources\views/auth/login.blade.php ENDPATH**/ ?>