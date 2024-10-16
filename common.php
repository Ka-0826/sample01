<?php
 
 function sanitize($posts) {
     foreach ($posts as $column => $post) {
         $posts[$column] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
     }
     return $posts;
 }
?>