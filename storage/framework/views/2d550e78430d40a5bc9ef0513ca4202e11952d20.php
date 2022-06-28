<!doctype html>
<html>
    <head>
        <script> BASE_URL="<?php echo e(url('/')); ?>/" </script>
        <?php echo $__env->yieldContent('script'); ?>
        <link rel='stylesheet' href="<?php echo e(url('css/guest.css')); ?>">
        <?php echo $__env->yieldContent('style'); ?>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <title><?php echo $__env->yieldContent('title'); ?></title>
    </head>
    <body>
        <?php echo $__env->yieldContent('navbar'); ?>
        <div id="regdiv">
            
                <?php echo $__env->yieldContent('content'); ?>
            
        </div>
       
    </body>
</html><?php /**PATH C:\Users\Matteo Celia\Laravel_projects\HW2\resources\views/layouts/guest.blade.php ENDPATH**/ ?>