

<?php $__env->startSection('title','7thArt-Cerca'); ?>

<?php $__env->startSection('style'); ?>
<link rel='stylesheet' href="<?php echo e(url('css/search.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/search.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h1 id="welcome">Ciao <?php echo e($username); ?>, cerca un film attraverso il titolo per conoscerne il rating IMDb!</h1>
            <form name='search' method='post'>
                <input type="text" name="title" placeholder="Inserisci il titolo di un film" id="title_search">
                <input type='submit' value='Cerca'>
            </form>
            
            <section id="filmview">
                <article id="film">
                    <div id="button"></div>
                    <h2 id="film_title"></h2>
                    <span id="rating"></span>
                    <img id="image">
                     
                </article>
            </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Matteo Celia\Laravel_projects\HW2\resources\views/search.blade.php ENDPATH**/ ?>