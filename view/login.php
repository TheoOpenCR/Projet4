<?php require(__DIR__."/../controller/controller.php");?>
<?php
if (isset($_POST["OK"])) {
    login();
}
?>

<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
<div class = "form">
    <form action="" method="post">
        <p>Se connecter à l'espace d'administration : </p>
        Pseudo : <input type="text" name="username" placeholder = "username">
        Mot de passe : <input type="password" name="password" placeholder = "Mot de passe">
        <input type="submit" name="OK" id="OK" value="Connecte toi !">
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require(__DIR__.'/template.php'); ?>

