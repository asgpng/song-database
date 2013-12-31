<h2>View Uploaded Files</h2>

<?php foreach ($files as $file) : ?>
<?php echo anchor('music/add_song/'.$file, 'Add ') ?>
<?php echo anchor('files/view/'.$file, $file) ?>
<br>
<?php endforeach ?>
