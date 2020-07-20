<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<p><a class="buttonBack" href="index.php">Retour à la liste des chapitres</a></p>
<?php $title ="Erreur" ?>
<?php ob_start(); ?>
<div class="error">
<div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">Erreur : </div>
<div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700"><?php echo $errorMessage; ?></div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require(__DIR__."/template.php"); ?>