<?php
require('controller/controller.php');

try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
    }
    else {
        listPosts();
    }
        
}