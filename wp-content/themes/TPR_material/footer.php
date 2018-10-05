<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cdb
 */
?>
<footer id="colophon" class="site-footer clearfix" role="contentinfo">
  <div class="container">
    <div class="row">
        <div class="col l6 s12 copyright">
            Copyright @ Google, All rights reserved. Powered by <a href="http://the-practice.net/" target="_blank">The PRactice</a>
        </div>
        <div class="col l6 s12 tpr-logo right-align"><img class="" src="<?php echo get_template_directory_uri().'/img/new-logo.png'; ?>"></div>
    </div>
  </div>
</footer><!-- #colophon -->
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri().'/js/jquery-2.1.1.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="<?php echo get_template_directory_uri().'/js/custom.js'; ?>"></script>
</body>
</html>
