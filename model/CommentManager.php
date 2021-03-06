<?php
require_once(__DIR__."/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, is_reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function reportComments($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET is_reporting = 1 WHERE id = ?');
        $comments->execute(array($id));
        
        return $comments;
        
    }

    public function reportedComments() 
    {
        $db = $this->dbConnect();
        $reportedComment = $db->query('SELECT comment, is_reporting, id FROM comments WHERE is_reporting = 1');

        return $reportedComment;
    }

    public function cancelcommentReporting($id)
    {
        $db = $this->dbConnect();
        $cancelReporting = $db->prepare('UPDATE comments SET is_reporting = 0 WHERE id = ?');
        $cancelReporting->execute(array($id));

        return $cancelReporting;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $deleteComment = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deleteComment->execute(array($id));

        return $deleteComment;
    }
}