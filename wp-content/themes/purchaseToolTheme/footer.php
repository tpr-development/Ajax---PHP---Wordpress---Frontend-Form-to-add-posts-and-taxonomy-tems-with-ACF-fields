    <footer class="mainfooter">
        <div class="row" data-equalizer data-equalize-on="medium">
            <div class="columns medium-5  small-12" data-equalizer-watch>
                <div class="widget menu-widget">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-links',
                            'menu_id' => 'footer-menu',
                            'container_class' => 'top-bar-left',
                            'menu_class' => 'vertical menu',
                            'walker' => new F5_TOP_BAR_WALKER(),
                            'depth' => 2,
                            'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s </ul>'
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
        <div class="last-footer">
            <div class="row">
                <div class="columns large-12 centre-footer-image">
                    <h2>Footer Logo</h2>
                </div>
                <div class="columns large-12">
                    <div class="copyright">© Copyright Content | Copyright 2007 Default Theme made in The PRactice, India.</div>
                </div>
            </div>
            
        </div>
    </footer>
</body>
<?php wp_footer(); ?>
</html>