<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
 <?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
 <?php endforeach; ?>
<?php echo $upload_data['file_name'] ?>
</ul>

<p><?php echo anchor('files/upload', 'Upload Another File!'); ?></p>

</body>
</html>