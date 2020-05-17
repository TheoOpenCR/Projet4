<?php
require('controller/controller.php');

try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        }
        else {
            // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }
    else {
        listPosts();
    }
        
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
