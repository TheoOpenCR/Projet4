<?php
require_once(__DIR__."/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, picture, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function postPost($title, $content, $picture)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, content, picture, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $posts->execute(array($title, $content, $picture));

        print_r($posts->errorInfo());


        return $affectedLines;
    }

    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $deletePost = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletePost->execute(array($postId));

        return $deletePost;

    }

    public function editPost($title, $content, $picture, $id)
    {
        $db = $this->dbConnect();
        $editPost = $db->prepare('UPDATE posts SET title = :title, content = :content, picture = :picture WHERE id = :id');
        $affectedLines = $editPost->execute(array(
            ":title" => $title,
            ":content" => $content,
            ":picture" => $picture,
            ":id" => $id
        ));

        return $affectedLines;
    }
}