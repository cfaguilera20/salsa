<i>user.php: available only when signed in, else redirect to signin.php. Shows the user name and
    email, and a link to change-password.php, and a link to sign-out.php.
</i>

<h1>User info</h1>
<label >Id: <?php echo $user->getId(); ?></label>
<label >Username: <?php echo $user->getUsername(); ?></label>
<label >Email: <?php echo $user->getEmail(); ?></label>
