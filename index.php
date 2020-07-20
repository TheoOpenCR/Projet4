<?php session_start(); ?>
<?php
require('controller/controller.php');
try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
    
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }   

        elseif ($_GET['action'] == "login") {
            header('location: view/login.php');
        }

        elseif ($_GET['action'] == 'report') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                reportComment($_GET['id']);
            }

            else {
                // Autre exception
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
            
        }

        elseif (isset($_GET['action']) && $_GET['action'] == "admin") {
            login();
        }

        elseif ($_GET['action'] == "cancelReport") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                cancelReporting($_GET['id']);
            }

            else {
                // Autre exception
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == "deleteComment") {
            deleteCommentReporting($_GET['id']);
        }

        elseif ($_GET['action'] == 'addPost') {
                if (!empty($_POST['title']) && !empty($_POST['chapter_content']) && !empty($_POST['picture'])) {
                    addPost($_POST['title'], $_POST['chapter_content'], $_POST['picture']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
        }   


    }
    else {
        listPosts();
    }

    
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    ?>
    <?php
        $errorMessage = $e->getMessage();
        require(__DIR__.'/View/errorView.php');
    ?>
    <?php
}
