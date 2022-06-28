

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/signup.js')); ?>" defer></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title','7thArt-Registrati!'); ?>

<?php $__env->startSection('content'); ?>
<main>
 <img src="./images/SeventhArt.png" id="title">
<h3>Registrati!</h3>
<form name='registration' method='post' autocomplete='off' action="/signup">
    <?php echo csrf_field(); ?>
    <p class="name">
        <label>Nome <input type='text' name='name' value="<?php echo e(old('name')); ?>" ></label>
        <span>Inserire solo lettere e spazi</span>
    </p>
    <p class="surname">
        <label>Cognome <input type='text' name='surname' value="<?php echo e(old('surname')); ?>"></label>
        <span>Inserire solo lettere e spazi</span>
    </p>
    <p class="username">
        <label>Username <input type='text' name='username' value="<?php echo e(old('username')); ?>" ></label>
        <span>Sono ammessi solo lettere, numeri e underscore.Max:16</span>
    </p>
    <p class="email">
        <label>E-mail <input type='text' name='email' value="<?php echo e(old('email')); ?>"></label>
        <span>Email non valida</span>
    </p>
    <p class="password">
        <label>Password <input class="psw" type='password' name='password'></label>
        <label>&nbsp;<input type="button" value="Mostra/nascondi password" class="password_show"></label>
        <span>Password non valida.Min:8</span>
    </p>
    <p class="confirm_password">
        <label>Confirm Password <input class="psw" type='password' name='confirm_password'></label>
        <label>&nbsp;<input type="button" value="Mostra/nascondi password" class="password_show"></label>
        <span>Le password non coincidono</span>
    </p>
    <p>
        <label>&nbsp;<input type='submit' value='Registrati' id="submit" disabled></label>
        </p>
</form>
<div class="accedi">Hai già un account?<a class="accedi" href="<?php echo e(url('login')); ?>">Accedi</a></div>          
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Matteo Celia\Laravel_projects\HW2\resources\views/signup.blade.php ENDPATH**/ ?>