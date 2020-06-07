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
                $_SESSION['username'] = $user;
                header('location: /../view/adminView.php');
            }
            else {
                throw new Exception('Mauvais identifiant ou mot de passe !');
            }
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    
        require(__DIR__."/../view/adminView.php");
        require(__DIR__."/../view/login.php");
    }
    catch(Exception $e) { // S'il y a eu une erreur, alors...
?>
    <div id="error">
        <?php
        echo 'Erreur : ' . $e->getMessage();
        ?>
    </div>
<?php
    }

}