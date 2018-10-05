<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cdb
 */
get_header();
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
<div class='row'>
    <div class='hide-on-large-only col s12'>
        <div class='section calendar'>
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>
                </div>
    </div>
    <div id="primary" class="content-area col m9">
      <main id="main" class="site-main" role="main">
    <?php
      $cat = get_term_by('name', single_cat_title('',false), 'category');
      $args = array(
        'posts_per_page' => -1,
	      'orderby' => 'date',
	      'order'   => 'DESC',
        'category_name' => $cat->slug
      );
      $query = new WP_Query( $args );
      if($query -> have_posts()) : while (have_posts()) : the_post();?>
        <div class="card">
          <div class="card-content">
            <span class="card-title"><?php the_title(); ?><?php edit_post_link('Edit', '', '', null, 'waves-effect waves-light btn-small'); ?></span>
            <p><?php the_content(); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
      </main>
    </div><!-- #primary -->
    <div class='col m3 hide-on-med-and-down'>
      <div class="toc-wrapper">
        <div class='calendar'>
          <?php if (is_active_sidebar('sidebar-1')) : ?>
            <?php dynamic_sidebar('sidebar-1'); ?>
          <?php endif; ?>
        </div>
        <div class="input-field monthly-dropdown">
          <h5>Browse by Month</h5>
          <select name="archive-dropdown" onchange="document.location.href = this.options[this.selectedIndex].value;">
            <option value=""><?php echo esc_attr(__('Select Month')); ?></option>
            <?php wp_get_archives(array('type' => 'monthly', 'format' => 'option')); ?>
          </select>
        </div>
      </div>
    </div>
    <?php else : ?>
      <?php get_template_part('template-parts/content', 'none'); ?>
    <?php endif; ?>
</div>
    <?php
global $wpdb;
$res = $wpdb->get_results(
    "SELECT MONTH(post_date) as post_month, COUNT(ID) as post_count " .
    "FROM {$wpdb->posts} " .
    "WHERE post_date BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW() AND post_type = 'post' " .
    "AND post_status = 'publish' " .
            "".
    "GROUP BY post_month ORDER BY post_date DESC", OBJECT_K
);
$postCount= 0;
$len = count($looper);

$cur = absint(date('n')); //absint -> Converts a value to a non-negative integer
if($cur > 1)
{
    $looper = array_merge(range($cur+1, 12), range(1, $cur));
}
else
{
    $looper = range(1, 12);
}

$out = '0,';
$postCount= '0';
$len = count($looper);
foreach($looper as $m)
{


    $month = date_i18n('F', mktime(0, 0, 0, $m, 1)); // date_i18n ->retrieve the date in localized format

    $out .= sprintf(
        '%s %d',
        $month,
        //'',
        isset($res[$m]) ? $res[$m]->post_count : 0
    );
    if ($postCount!= $len-1) {
        $out .= ',';
    }

    $postCount++;

}
//$out .= '</ul>';

// echo $out; uncomment this to echo monthwise count
?>
</div>
</div>
<?php get_footer(); ?>
