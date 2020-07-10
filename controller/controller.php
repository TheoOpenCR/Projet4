<php session_start() ?>
<?php


// Chargement des classes
require_once(__DIR__."/../model/PostManager.php");
require_once(__DIR__."/../model/CommentManager.php");
require_once(__DIR__."/../model/AdminManager.php");

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require(__DIR__."/../view/listPostsView.php");
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require(__DIR__."/../view/postView.php");
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function login()
{
    try{
        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
    
            $adminManager = new AdminManager();
            $user = $adminManager->getLogin($username);

            if (isset($user['username']) && $_POST['username'] == $user['username'] && $_POST['password'] == $user['password']) {
                $_SESSION['admin'] = true;
                $_SESSION['username'] = $user['username'];
                showReportComment();
                
                
            }
            else {
                throw new Exception( 'Mauvais identifiant ou mot de passe ! ');
            }
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis ! ');
        }
    }
    catch(Exception $e) { // S'il y a eu une erreur, alors...
?>
    <div id="error">
        <?php
            header('Location: ../view/login.php' ); 
            echo 'Erreur : ' . $e->getMessage();
        ?>
    </div>
<?php
    }

}

function reportComment($id)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->reportComments($id);

    echo "Votre commentaire à bien été signalé, il sera traité au plus vite par les administateurs.";
    ?>
    <p><a class="buttonBack" href="../index.php">Retour à la liste des chapitres</a></p>
    <?php

}

function showReportComment()
{
    $commentManager = new CommentManager();

    $reportedComment = $commentManager->reportedComments();

    require(__DIR__."/../view/adminView.php");

}

function cancelReporting($id) 
{
    $commentManager = new CommentManager();

    $cancelReporting = $commentManager->cancelcommentReporting($id);

    header('Location: ../view/adminView.php' ); 

    echo "Le commentaire n'est plus signalé. Vous avez jugé qu'il étais approprié . ";
    ?>
    <p><a class="buttonBack" href="../index.php">Retour à la liste des chapitres</a></p>
    <?php
}

function deleteCommentReporting($id)
{
    $commentManager = new CommentManager();

    $deleteComment = $commentManager->deleteComment($id);

    require(__DIR__."/../view/adminView.php");

    echo "Le commentaire à été supprimé";
    ?>
    <p><a class="buttonBack" href="../index.php">Retour à la liste des chapitres</a></p>
    <?php
}
?>
