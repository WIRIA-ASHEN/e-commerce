<h1>Welcome User</h1>
<form action="<?php echo e(route('logout')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <button type="submit">Logout</button>
</form>
<?php /**PATH C:\laragon\www\e-commerce\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>