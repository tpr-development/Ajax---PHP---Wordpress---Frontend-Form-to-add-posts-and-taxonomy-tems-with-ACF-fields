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
if ( !is_user_logged_in() ) {
   auth_redirect();
}
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
            <a href="<?php echo $url; ?>" class="brand-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/practice-logo.png" alt="Google media monitor" /> <?php bloginfo( 'name' ); ?></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="<?php echo $url; ?>/wp-login.php?action=logout">Log Out</a></li>
              <li><a href="#" data-target="slide-out" class="sidenav-trigger" style="display: block;"><i class="material-icons">menu</i></a></li>
            </ul>
          </div>
        </nav>
        <ul id="slide-out" class="sidenav">
          <a href="<?php echo $url; ?>" class="branding"><?php bloginfo( 'name' ); ?></a>
          <li><a href="<?php echo $url; ?>/create-a-post/" class="waves-effect">Create PR</a></li>
          <li><a href="<?php echo $url; ?>/add-a-vendor/" class="waves-effect">Add Vendor</a></li>
        </ul>
