<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cdb
 */
get_header();
if (have_posts()) :
    $posts = $category_list = $table_element = '';
    $count = 0;
    $year = get_query_var('year');
    $monthnum = get_query_var('monthnum');
    $day = get_query_var('day');
    $categories = get_categories(array(
    'orderby' => 'slug',
    'order' => 'ASC'
    ));
    foreach ($categories as $category) {
        $args = array(
            'posts_per_page' => -1,
            'category_name' => $category->slug,
            'date_query' => array(
                array(
                    'year' => $year,
                    'month' => $monthnum,
                    'day' => $day,
                ),
            ),
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            $posts = $posts . '<div class="category-block ' . $category->slug . ' section scrollspy" id="' . $category->slug . '"><div class="sectionTitle">' . $category->name . '</div>';
            $category_list = $category_list . '<li><a href="#' . $category->slug . '">' . $category->name . '</a></li>';
            $table_element = $table_element . '<tr><td class="category_name">' . $category->name . '</td>';
        endif;
        while ($query->have_posts()) : $query->the_post();
            $posts = $posts . '<div class="card"><div class="card-content">';
            $posts = $posts . '<span class="card-title">' . get_the_title() . '</span>';
            $posts = $posts . '<p>'.get_the_content().'</p>';
            if(has_tag()){
                $posttags = get_the_tags();
                foreach($posttags as $tag) {
                    $posts = $posts . '<span class="tag '.$tag->slug.'">'.$tag->name.'</span>';
                }
            }
            $posts = $posts . '</div></div>';
            $count++;
        endwhile;
        if ($query->have_posts()):
            $table_element = $table_element . '<td class="category_no">' . $count . '</td></tr>';
        endif;
        $count = 0;
        if ($query->have_posts()) :
            $posts = $posts . '</div>';
        endif;
    }
    ?>
    <!-- Page Title -->
    <div class="page-title-container">
    	<div class="col m12 center-align">
    		<h1 class="page-title screen-reader-text"><?php the_archive_title(); ?></h1>
    	</div>
    </div>
    <!-- Page content -->
    <div class="page-content">
    	<div class="container">
        <div class="row">
          <div class="hide-on-large-only col s12 ">
            <div class="content-list"><div class="sectionTitle">Categories</div>
              <ul class="section table-of-contents">
                <?php echo $category_list; ?>
              </ul>
            </div>
          </div>
    <div id="primary" class="content-area col m9">
      <main id="main" class="site-main" role="main">
        <?php
        if (is_month()) {
            if ($table_element != '') {
                echo '<div class="post-count"><table class="striped"><thead><tr><th class="category_name">Category</th><th class="category_no">Stories</th></tr></thead><tbody>' . $table_element . '</tbody></table></div>';
            }
        }
        echo $posts;
        ?>
      </main>
    </div>
    <div class="col m3 hide-on-med-and-down">
      <div class="toc-wrapper content-list">
        <ul class=" table-of-contents">
            <div class="sectionTitle">Categories</div>
            <?php
            echo $category_list;
            ?>
            </ul>
            <div class='calendar'>
                <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="hide-on-med-and-up col s12">
        <div class='calendar'>
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>

    <?php get_template_part('template-parts/content', 'none'); ?>

<?php endif; ?>
</div></div></div>
<?php get_footer(); ?>
