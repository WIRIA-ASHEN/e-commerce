

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Produk</h2>
            <p>Jumlah produk yang tersedia: <?php echo e($jumlahproduk); ?></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Pesanan</h2>
            <p>Jumlah pesanan yang diterima: <?php echo e($totalpesanan); ?></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Pengguna</h2>
            <p>Jumlah pengguna terdaftar: <?php echo e($jumlahuser); ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-commerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>