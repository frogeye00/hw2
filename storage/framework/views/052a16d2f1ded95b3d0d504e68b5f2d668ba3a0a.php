

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(url('js/login.js')); ?>" defer></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel='stylesheet' href="<?php echo e(url('css/login.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title','7thArt-Accedi!'); ?>

<?php $__env->startSection('content'); ?>
<main id="login">
                <img src="./images/SeventhArt.png" id="title">
<h3>Accedi!</h3>
                <?php if($error=='wrong'): ?>
                <section class="errore">Username e/o password non validi </section>
                <?php endif; ?>
                
                <form name='login' method='post' action="<?php echo e(url('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <p class="username">
                        <label>Username <input type='text' name='username' value="<?php echo e(old('username')); ?>"></label>
                    </p>

                    <p class="password">
                        <label>Password <input type='password' name='password' id="password">
                          
                        </label>
                        <label>&nbsp;<input type="button" value="Mostra/nascondi password" id="password_show"></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type='submit' value='Accedi'></label>
                    </p>
                </form>
                <div class="accedi">Non hai ancora un account?<a class="accedi" href="<?php echo e(url('signup')); ?>">Registrati</a></div>
                </main>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Matteo Celia\Laravel_projects\HW2\resources\views/login.blade.php ENDPATH**/ ?>