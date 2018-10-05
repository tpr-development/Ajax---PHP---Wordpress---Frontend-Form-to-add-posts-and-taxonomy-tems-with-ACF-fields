<form role="search" method="get" class="input-group" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <!-- <div class="search-wrap"> -->
    	<!-- <label class="screen-reader-text" for="s"><?php // _e( 'Search for:', 'presentation' ); ?></label> -->
        <input type="search" placeholder="<?php echo esc_attr( 'Search', 'presentation' ); ?>" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <button class="button" type="submit" id="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    <!-- </div> -->
</form>