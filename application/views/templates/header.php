<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Adam Gallagher">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/css/bootstrap.css')?>">
    <title><?php echo $title ?> - Song Database</title>

    <script src="/songs/codemirror/lib/codemirror.js"></script>
    <script src="/songs/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="/songs/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="/songs/codemirror/mode/xml/xml.js"></script>
    <script src="/songs/codemirror/mode/javascript/javascript.js"></script>
    <script src="/songs/codemirror/mode/css/css.js"></script>
    <script src="/songs/codemirror/mode/clike/clike.js"></script>
    <script src="/songs/codemirror/mode/php/php.js"></script>
    <script src="/songs/application/static/js/jquery-2.0.3.min.js"></script>
    <script src="/songs/application/static/js/bootstrap.js"></script>
    <style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
    <!-- <link rel="stylesheet" href="/songs/codemirror/doc/docs.css"> -->
    <link rel="stylesheet" href="/songs/codemirror/lib/codemirror.css">

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img class="nav" src="<?php echo base_url('application/static/images/princeton.png'); ?>" width="20" height="20">
          <?php echo anchor('/', 'Song Database', 'class="brand"'); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><?php echo anchor('/', 'Home'); ?></li>
            </ul>
          </div>
          <ul class="nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Songs<b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo anchor('music', 'View Songs'); ?></li>
                <li><?php echo anchor('music/edit', 'Edit Songs'); ?></li>
                <li><?php echo anchor('files/upload', 'Upload'); ?></li>
                <li><?php echo anchor('files/view_files', 'View Uploads'); ?></li>
              </ul>
            </li>
          </ul>
          <ul class="nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Sets<b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo anchor('sets', 'View Sets'); ?></li>
                <li><?php echo anchor('sets/choose_songs', 'New Set'); ?></li>
              </ul>
            </li>
          </ul>
          <ul class="nav">
            <li><?php echo anchor('about', 'About'); ?></li>
            <li><?php echo anchor('contact', 'Contact'); ?></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
