<h1>Welcome Admin</h1>
<form action="<?php echo e(route('logout')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <button type="submit">Logout</button>
</form>
<?php /**PATH C:\laragon\www\e-commerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>