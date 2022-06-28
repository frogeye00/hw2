<!DOCTYPE html>
<html>

    <head>
        <script> BASE_URL="<?php echo e(url('/')); ?>/" </script>
        <?php echo $__env->yieldContent('script'); ?>
        <link rel='stylesheet' href="<?php echo e(url('css/main.css')); ?>">
        <?php echo $__env->yieldContent('style'); ?>


        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo $__env->yieldContent('title'); ?></title>
    </head>
    <body>
        <nav>
        <a href="<?php echo e(url('homepage')); ?>">Home</a>
        <a href="<?php echo e(url('search')); ?>">Cerca</a>
        <a href="<?php echo e(url('create')); ?>">Nuovo post</a>
        <a href="<?php echo e(url('favorites')); ?>">Preferiti</a>
        <a href="<?php echo e(url('logout')); ?>">Logout </a>
        </nav>
        <header>
            <div id ="overlay"></div>
            <div class ='flex-container'>
            <img id="title" src="./images/SeventhArt.png">
            </div>
        </header>
        
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <footer>
            <p>
                <div class ='flex-container'>
                <p id="footer">Matteo Celia <br> N°Matricola:1000001836</p>
                </div>
            </p>
        </footer>
    </body>
</html><?php /**PATH C:\Users\Matteo Celia\Laravel_projects\HW2\resources\views/layouts/main.blade.php ENDPATH**/ ?>