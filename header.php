<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="description" content="Join the global conflict in this massive online turn based strategy wargame.">
    <meta content="<?php bloginfo('description') ?>" name="description">
    <meta content="maximum-scale=1.0, width=device-width" name="viewport">

    <title><?php bloginfo('title') ?></title>
    
    <link href="<?= get_template_directory_uri() ?>/favicon.ico" rel="shortcut icon">
    <link href="<?= get_template_directory_uri() ?>/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400' rel='stylesheet' type='text/css'>
    <?php wp_head(); ?>

    <?php js('required') ?>
    <?php js('global', 'required') ?>
</head>