<?php
    $post = app\app::getDb()->prepare('SELECT * FROM posts WHERE id = ?', [$_GET['id']], 'app\table\posts', true);
?>

<h1><?= $post->title; ?></h1>

<p><?= $post->content; ?></p>

<p>Posté par <?= $post->author . ', le ' . $post->date; ?> .</p>