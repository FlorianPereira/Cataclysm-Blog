<!-- Manual data insertion -->
<?php /*
    $tab = [
    'title' => 'Roblochon',
    'author' => 'Francine',
    'content' => 'Curabitur at nunc in erat lacinia eleifend accumsan ut enim. Ut nisi tortor, semper non dapibus sed, rutrum eget purus. Duis at lobortis orci. Nullam iaculis dapibus odio, sed porta purus dictum porttitor. Donec faucibus velit nec massa pellentesque finibus. Duis ultricies est dui, et consectetur mi tempus vitae. Fusce vitae justo velit. Donec ut justo ornare, convallis tellus bibendum, mollis purus. Praesent ex ex, malesuada a venenatis in, luctus sit amet lacus. Nulla euismod scelerisque odio id blandit. Nulla facilisi. Nulla sit amet orci ut lorem lobortis pellentesque.
                ',
    'date' => date('c'),
    'id_tags' => 2
    ];
    app\app::getDb()->insert('posts', $tab);
 */
?>

<div class="row">
    <div class="col-sm-8">
        <!-- Article's list form SQL query to the database -->
        <ul>
            <!-- Connect to the database and display each article -->
            <?php foreach(app\table\posts::getLast() as $post): ?>
                <!-- Article's link on the title -->
                <h2><a href="<?= $post->getURL(); ?>"><?= $post->title; ?></a></h2>
                <!-- Article's list form SQL query to the database -->
                <p><?= $post->getExtract(); ?></p>

            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-sm-4">
        <ul>
            <?php foreach(app\table\tags::getData() as $tags): ?>
            <li><a href="<?= $tags->getURL(); ?>"><?= $tags->tag_title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

