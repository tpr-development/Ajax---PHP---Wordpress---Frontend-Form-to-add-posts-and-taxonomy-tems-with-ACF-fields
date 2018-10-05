<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cdb
 */
// Require login for site
//get_currentuserinfo();
//global $user_ID;
//if ($user_ID == '') {
//    header('Location: /wp-login.php');
//    exit();
//}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <nav class="top-bar">
          <div class="nav-wrapper">
            <?php $url = site_url(); ?>
            <a href="<?php echo $url; ?>" class="brand-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/google_PNG2.png" alt="Google media monitor" /> <?php bloginfo( 'name' ); ?></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="<?php echo $url; ?>/wp-login.php?action=logout">Log Out</a></li>
              <li><a href="#" data-target="slide-out" class="sidenav-trigger" style="display: block;"><i class="material-icons">menu</i></a></li>
            </ul>
          </div>
        </nav>
        <ul id="slide-out" class="sidenav">
          <a href="<?php echo $url; ?>" class="branding"><img src="<?php echo get_template_directory_uri(); ?>/img/google_PNG2.png" alt="Google media monitor" class="responsive-img"/> <div><?php bloginfo( 'name' ); ?></div></a>
          <li><a href="<?php echo $url; ?>/all-weekly-reports/" class="waves-effect">Weekly Reports</a></li>
          <li><div class="divider"></div></li>
          <li><a class="subheader waves-effect">Daily Reports</a></li>
          <!-- <li><a class="waves-effect" href="#!">Third Link With Waves</a></li> -->
          <?php
          if ( is_active_sidebar( 'sidebar-1' ) ) {
          	 dynamic_sidebar( 'sidebar-1' );
          }
          ?>
        </ul>
