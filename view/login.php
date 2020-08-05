<?php $title = 'Administration'; ?>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="../public/css/style.css" rel="stylesheet" /> 
</head>

<p><a class="buttonBack" href="../index.php">Retour à la liste des chapitres</a></p>

<div class="img">
        <img src="https://res.cloudinary.com/theosj/image/upload/w_432/v1593692578/Projet4/panorama_zhixog.jpg">
</div>
<div class = "form">
    <form action="../index.php?action=admin" method="post">
        <p>LOGIN </p>
        <input type="text" name="username" placeholder = "Username" class="inputLogin"> <br />
        <input type="password" name="password" placeholder = "Mot de passe" class="inputLogin"> <br />
        <input type="submit" name="OK" id="OK" value="Connecte toi !">
    </form>
</div>
