<br><h1>I am main VIEV</h1><br>


<p><?= $name ?></p>
<p><?= $age ?></p>

<p>Our posts: </p>
<?php foreach ($posts as $post): ?>
    <h4><?= $post->title; ?></h4>
<?php endforeach; ?>