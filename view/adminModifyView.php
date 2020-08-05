<?php $title = 'Modification des chapitres'; ?>
</br>
</br>
<?php ob_start(); ?>
Ici vous pouvez modifier le chapitre que vous avez séléctionner.
<form action="../index.php?action=modifyPost&id=<?= $_GET['id'] ?>" method="post">
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

<?php require(__DIR__."/template.php"); ?>

<head>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<title><?= $title ?></title>
<link href="../public/css/style.css" rel="stylesheet" /> 
<script>
    tinymce.init({
      selector: '#chapter_content',
    });
  </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>