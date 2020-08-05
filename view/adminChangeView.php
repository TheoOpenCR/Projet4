<?php $title = 'Modification des chapitres'; ?>
<p><a  class="buttonBack" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
</br>
</br>
<?php ob_start(); ?>

 <p class="reportComment"><?php echo "Sur cette page, vous allez pouvoir modifier un chapitre qui à déjà été publié ou supprimer un chapitre si besoin !"; ?> </p>
</br>
</br>
 <?php
while ($data = $posts->fetch())
{
?>
        <h3 class="titleChange">
            <?= htmlspecialchars($data['title']) ?> </br> </br> <a class="bg-transparent hover:bg-red-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="Projet4/../index.php?action=deletePost&id=<?= $data['id'] ?>">Supprimer le chapitre</a>
            <a class="bg-transparent hover:bg-green-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="view/adminModifyView.php?id=<?= $data['id'] ?>">Modifier le chapitre</a>
        </h3>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require(__DIR__."/template.php"); ?>

<head>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
      selector: '#chapter_content',
    });
  </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>

