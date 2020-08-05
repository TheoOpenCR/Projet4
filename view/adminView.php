
<?php $title = 'Administration'; ?>
<p><a  class="buttonBack" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
<h1 class="admin">Espace d'administration</h1>
<div class="report">
    <p class="reportComment"><?php echo "Bonjour ",  $_SESSION['username'], ". Bienvenue dans l'espace d'administration ! Ici vous pourrez rédiger vos chapitres pour les publiers sur le site !" ?></p>
    <br/>
    <p class="reportComment"><?php echo "Voici tous les commentaires présents sur vos différents chapitres qui ont été signalé par des visiteurs : " ?></p>
    <br/>
    <?php 
        while ($commentReport = $reportedComment->fetch()) 
        {
               ?> <p class="reportComment"> <em><?php echo $commentReport['comment']; ?> </em>     <a class="bg-transparent hover:bg-green-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="Projet4/../index.php?action=cancelReport&id=<?= $commentReport['id'] ?>">Annuler le signalement</a>  <a class="bg-transparent hover:bg-red-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="Projet4/../index.php?action=deleteComment&id=<?= $commentReport['id'] ?>">Supprimer le commentaire</a></p>
                <br/>
                <?php
        }

    ?>
</div>
<?php ob_start(); ?>
<h1 class="font-bold text-xl mb-2">Edition d'un nouveau Chapitre</h1>

<form action="index.php?action=addPost" method="post">
    <div class="form-group">
        <label class="block text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4" for="title">Titre du chapitre :</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" id="title" name="title" />
    </div>
    <div class="form-group">
        <label class="block text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4" for="chapter_content">Contenu du chapitre :</label>
        <textarea  id="chapter_content" name="chapter_content"></textarea>
    </div>
    <div class="form-group">
        <label class="block text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4" for="picture">Lien cloudinary pour une image :</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" id="picture" name="picture" />
    </div>
    <div class="form-group">
        <input type="submit" value="Enregistrer" class="valid" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require(__DIR__.'/template.php'); ?>

<head>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#chapter_content',
    });
  </script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
<head>

<p class="reportComment">Cliquer pour pouvoir modifier ou supprimer un chapitre : </p>
</br>

<h1><a class="bg-transparent hover:bg-green-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="index.php?action=changePost">Modification d'un Chapitre</a></h1>
</br>
</br>
</br>
