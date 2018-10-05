<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!doctype html>
<html class="no-js"  <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title(); ?> | <?php bloginfo('name'); ?></title>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="off-canvas-wrapper">
            <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
                <div class="off-canvas position-left" id="off-canvas" data-off-canvas>
                    <?php foundation_offcanvas_left(); //defined in functions.php, calling primary menu to offcanvas menu ?>
                    <?php foundation_offcanvas_right(); //defined in functions.php, calling secondary menu to offcanvas menu ?>
                </div>
                <div class="off-canvas-content" data-off-canvas-content>
                    <header class="header" role="banner">
                        <?php get_template_part( 'parts/nav', 'topMenu' ); ?>
                    </header>
                    <div class="crumbs">
	                    <div class="row">
	                    	<div class="columns small-12 breadcrumb-container"><?php if ( function_exists('yoast_breadcrumb') ) 
	                        {yoast_breadcrumb('<ul class="breadcrumbs">','</ul>');} ?>
	                        </div>
	                    </div>
	                </div>