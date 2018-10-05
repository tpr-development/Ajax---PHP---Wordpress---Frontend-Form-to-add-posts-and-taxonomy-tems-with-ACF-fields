<div class="hide-for-large">
    <ul class="menu responsiveMenu">
        <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> 
        <li><a data-toggle="off-canvas"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
        <li><h1 class="site-branding"><?php bloginfo('name'); ?></h1></li>
    </ul>
</div>

<nav class="top-bar row show-for-large" id="nav-menu">
    <div class="columns large-2">
        <div class="site-branding">
            <!-- <a href="<?php // the_permalink(); ?>"> --><h1>Logo<!-- <img src="/ilovemaple/wp-content/themes/ilovemaple-2/image/logo.png" class="logo"/> --></h1><!-- </a> -->
        </div>
    </div>
    <div class="columns large-10">
        <!-- <div class="row">
            <div class="top-bar-right socialIconGroup">
                <a class="facebook" href="#" target="_blank"><img src="/wp-content/themes/default/image/facebook.png"/></a>
                <a class="twitter" href="#" target="_blank"><img src="/wp-content/themes/default/image/twitter.png"/></a>
                <a class="instagram" href="#" target="_blank"><img src="/wp-content/themes/default/image/instagram.png"/></a>
                <a class="linkedin" href="#" target="_blank"><img src="/wp-content/themes/default/image/linkedin.png"/></a>
            </div>
        </div> -->
        <div class="row">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-nav',
                'menu_id' => 'left-menu',
                'container_class' => 'top-bar-right clearfix',
                'menu_class' => 'vertical medium-horizontal menu dropdown ',
                'walker' => new F5_TOP_BAR_WALKER(),
                'depth' => 2,
                'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s </ul>'
                    )
            );
            ?>
        </div>
    </div>
</nav>