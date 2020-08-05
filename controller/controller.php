<php session_start();?>
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

function listPosts2()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require(__DIR__."/../view/adminChangeView.php");
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
        <?php
            $errorMessage = $e->getMessage();
            require("view/errorView.php");
        ?>
<?php
    }

}

function reportComment($id)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->reportComments($id);

    ?>
    <p style="text-align : center; font-size : 20px; margin-top : 20px;">Votre commentaire à bien été signalé, il sera traité au plus vite par les administateurs. </p>
    <p><a style="color: black; border: 1px solid black; font-size: 20px; text-decoration: none; padding : 10px;" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
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
    
    ?>
    <p style="text-align : center; font-size : 20px; margin-top : 20px;">Le commentaire n'est plus signalé. Vous avez jugé qu'il étais approprié . </p>
    <p><a style="color: black; border: 1px solid black; font-size: 20px; text-decoration: none; padding : 10px;" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
    <?php
}

function deleteCommentReporting($id)
{
    $commentManager = new CommentManager();

    $deleteComment = $commentManager->deleteComment($id);

    ?>
    <p style="text-align : center; font-size : 20px; margin-top : 20px;">Le commentaire à été supprimé </p>
    </div>
    <p><a style="color: black; border: 1px solid black; font-size: 20px; text-decoration: none; padding : 10px;" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
    <?php
}

function addPost($title, $content, $picture)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->postPost($title, $content, $picture);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else {
        header('Location: index.php?action=listPosts');
    }
}

function removePost($postId)
{
    $postManager = new PostManager();
    $deletePost = $postManager->deletePost($postId);


    ?>
    <p style="text-align : center; font-size : 20px; margin-top : 20px;">Le chapitre à été supprimé </p>
    </div>
    <p><a style="color: black; border: 1px solid black; font-size: 20px; text-decoration: none; padding : 10px;" href="Projet4/../index.php">Retour à la liste des chapitres</a></p>
    <?php
}

function changePost($title, $content, $picture, $id)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->editPost($title, $content, $picture, $id);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le chapitre !');
    }
    else {
        header('Location: index.php?action=listPosts');
    }

}
?>
