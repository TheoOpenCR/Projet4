<?php

// Chargement des classes
require_once('Projet20/model/PostManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

}