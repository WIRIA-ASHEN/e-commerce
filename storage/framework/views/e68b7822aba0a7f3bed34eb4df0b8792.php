<!DOCTYPE html>
<html>

<head>
    <title>Black Matrix Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>
    <div class="container">
        <div class="form">
            <h1>E-commerce</h1>
            <p>Konnco Studio</p>
            <form action="<?php echo e(route('login')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                
                <button type="submit">LOGIN</button>
                <p>New to Black Matrix? <a href="#">Sign up here.</a></p>
            </form>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\e-commerce\resources\views/auth/login.blade.php ENDPATH**/ ?>