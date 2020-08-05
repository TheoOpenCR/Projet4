<?php $title = 'Billet simple pour l\'Alaska'; ?>

<div id="navBar">
<a class="buttonBack" href="view/login.php">Administration</a>

<?php ob_start(); ?>
<h1>Jean Forteroche</h1>
<h2>Billet simple pour l'Alaska</h2>
</div>


<?php
while ($data = $posts->fetch())
{
?>
<div class="post">
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
            <?= substr(htmlspecialchars_decode($data['content']), 0, 1000) ?> <?php echo "..." ?>
            <br />
            <br />
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em> 
        
    </div>

    <div class="img">
        <img src="<?= htmlspecialchars($data['picture']) ?>">
    </div>

</div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>


<?php require(__DIR__."/template.php"); ?>