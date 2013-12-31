<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Adam Gallagher">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/bootstrap.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/default.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/edits.css'); ?>">

    <title><?php echo $title ?> - Song Database</title>
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
          <img class="nav" src="<?php echo base_url('static/images/princeton.png'); ?>" width="20" height="20">
          <?php echo anchor('/', 'Song Database', 'class="brand"'); ?>
          <div class="nav-collapse collapse">
            <!-- <ul class="nav"> -->
            <!--   <li><?php echo anchor('/', 'Home'); ?></li> -->
            <!--   <li><?php echo anchor('about', 'About'); ?></li> -->
            <!--   <li><?php echo anchor('contact', 'Contact'); ?></li> -->
            <!-- </ul> -->
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <!-- <div class="row-fluid"> -->
      <!--   <div class="span3"> -->
      <!--     <div class="well sidebar-nav"> -->
      <!--       <ul class="nav nav-list"> -->
      <!--         <li>Welcome to this Song Database website. Please login to access the rest of the site.</li> -->
      <!--       </ul> -->
      <!--     </div> -->
      <!--   </div> -->
      <!--   <div class="span9"> -->
