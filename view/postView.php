<?php $title = htmlspecialchars($post['title']); ?>
 
 <?php ob_start(); ?>
    <div id="postView">
        <h1>Roman de Jean Forteroche</h1>
        <p><a class="buttonBack" href="index.php">Retour à la liste des chapitres</a></p>
    </div>

    <div class="post">
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>


        <div class="comment">
            <h2>Commentaires</h2>

            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <div>
                    <label for="author">Nom :   </label>
                    <input type="text" id="author" name="author" />
                </div>
                <br />
                <div>
                    <label class="addcomment" for="comment">Commentaire :</label>
                    <textarea id="addcomment" name="comment"></textarea>
                </div>
                <br />
                <div>
                    <input type="submit" class="Valid"/>
                </div>
            </form>

            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?>  <a class="buttonReport" href="index.php?action=report&id=<?= $comment['id'] ?>">Signaler</a></p>
            <?php
            }
            ?>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require(__DIR__.'/template.php'); ?>