<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<form action="view/adminView.php" method="post">
    <label>Pseudo : </label><input type="text" name="pseudo">
    Mot de passe : <input type="password" name="password">
    <input type="submit" value="Valider">
</form>
<?php $header = ob_get_clean(); ?>


<?php ob_start(); ?>
<h1>Roman de Jean Forteroche</h1>
<p>Derniers chapitres du roman : </p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>