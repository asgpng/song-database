<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Adam Gallagher">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('codemirror/lib/codemirror.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('codemirror/addon/dialog/dialog.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('static/css/jquery-ui.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/default.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/edits.css'); ?>">

    <!-- javascript -->
    <script src="<?php echo base_url('codemirror/lib/codemirror.js'); ?>"></script>
    <script src="<?php echo base_url('codemirror/addon/edit/matchbrackets.js'); ?>"></script>
    <script src="<?php echo base_url('codemirror/addon/search/searchcursor.js'); ?>"></script>
    <script src="<?php echo base_url('codemirror/addon/search/search.js'); ?>"></script>
    <script src="<?php echo base_url('codemirror/addon/dialog/dialog.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/jquery-2.0.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/jquery.form.js'); ?>"></script>
    <script src="<?php echo base_url('static/js/personal.js'); ?>"></script>

    <script>
     function set_action() {
       var action = "<?php if (isset($search_action)) echo $search_action; ?>";

       if (action != null) {
         document.song_search.action = action;
       }
       else {
         document.song_search.action = '';
       }
     };
    </script>

    <title><?php echo $title ?> - Song Database</title>
  </head>
  <body onload="set_action();">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img class="nav" src="<?php echo base_url('static/images/princeton.png'); ?>" style="height: 20px; width: 20px;">
          <?php echo anchor('/', 'Song Database', 'class="brand"'); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><?php echo anchor('/', 'Home'); ?></li>
            </ul>
            <ul class="navbar-text pull-right">
              <li>
                Logged in as <a href="<?php echo site_url('logout'); ?>" class="navbar-link"><?php echo $this->session->userdata('netID')?></a>
              </li>
            </ul>
          </div>
          <ul class="nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Songs<b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo anchor('music', 'View Songs'); ?></li>
                <!-- <li><?php echo anchor('music/edit', 'Edit Songs'); ?></li> -->
                <!-- <li><?php echo anchor('files/upload', 'Upload'); ?></li> -->
                <!-- <li><?php echo anchor('files/view_files', 'View Uploads'); ?></li> -->
                <?php if ($this->session->userdata('user_type') == 'admin') : ?>
                  <li><?php echo anchor('music/delete_songs', 'Delete Songs'); ?></li>
                <?php endif ?>
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
                <li><?php echo anchor('sets/new_set', 'New Set'); ?></li>
                <li><?php echo anchor('sets/current_set', 'Current Set'); ?></li>
              </ul>
            </li>
          </ul>
          <!--          <ul class="nav">
          <li><?php echo anchor('about', 'About'); ?></li>
          <li><?php echo anchor('contact', 'Contact'); ?></li>
          </ul> -->
          <form class="navbar-search pull-right" method="POST" name="song_search" id="song_search" action="">
            <input type="text" class="search-query" placeholder="Search" name="search_query">
          </form>
        </div>
      </div>
    </div>

    <div class="container">
