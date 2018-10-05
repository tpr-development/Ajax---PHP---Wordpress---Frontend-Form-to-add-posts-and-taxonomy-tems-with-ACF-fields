<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package cdb
 */
get_header();
/* Search Count */
$allsearch = &new WP_Query("s=$s&showposts=-1");
$key = wp_specialchars($s, 1);
$count = $allsearch->post_count;
wp_reset_query();
?>
<section class="content-body">
    <h5 class="hide-on-large-only"><?php printf(esc_html__('Search Results for: %s', 'cdb-test'), '<span>' . get_search_query() . '</span>'); ?></h5>
            <?php if (have_posts()) : ?>
    <div class="quicksearch">
                <div class="input-field">
                    
                    <input id="input" type="text" class="quicksearch_field">
                    <label for="input"><i class="material-icons prefix">find_in_page</i> Filter this page</label>
                </div>
    </div>
                
                <?php /* Start the Loop */ ?>
                <div class="sorts-container grey-text">
                    <strong class="flow-text"><?php echo $count; ?> search results&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    <span id="sorts" class="hide-on-med-and-down"><strong>Sort by: </strong>
                        <button class="waves-effect waves-dark btn grey-text z-depth-0" data-sort-value="name">Name<!-- <i class="material-icons right">keyboard_arrow_up</i>--></button>
                        <button class="waves-effect waves-dark btn grey-text z-depth-0" data-sort-value="publications">Publications<!-- <i class="material-icons right">keyboard_arrow_up</i>--></button>
                        <button class="waves-effect waves-dark btn grey-text z-depth-0" data-sort-value="city">City<!-- <i class="material-icons right">keyboard_arrow_up</i>--></button>
                    </span>
                </div>
                <ul class="table-like">
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="table-like__item">
                            <span class="name">
                                <?php $i = 0; ?>
                                <a href="<?php the_permalink(); ?>" class="profile-link text-primary"><h5><?php the_title(); ?></h5>
                                    <span class="beat sub-title"><?php
                                        $term_list = wp_get_post_terms($post->ID, 'beat', array("fields" => "all"));
                                        foreach ($term_list as $term) {
                                            if ($i != 0)
                                                echo ', ';
                                            echo $term->name;
                                            $i++;
                                        }
                                        ?></span>
                                </a>
                            </span>
                            <span class="contact hide-on-med-and-down">
                                <?php if (get_field('email_work')) { ?><a href="mailto:<?php the_field('email_work'); ?>" target="_blank" title="email" class="email_work btn-floating teal"><i class="material-icons">email</i></a><?php } ?>
                                <?php if (get_field('email_personal')) { ?><a href="mailto:<?php the_field('email_personal'); ?>" target="_blank" title="email" class="email-personal btn-floating yellow"><i class="material-icons">mail_outline</i></a><?php } ?>
                                <?php if (get_field('office')) { ?><a href="tel:<?php the_field('office'); ?>" title="office" class="office btn-floating blue"><i class="material-icons">phone</i></a><?php } ?>
                                <?php if (get_field('mobile')) { ?><a href="tel:<?php the_field('mobile'); ?>" title="mobile" class="mobile btn-floating violet"><i class="material-icons">stay_current_portrait</i></a><?php } ?>
                            </span>
                            <div class="fixed-action-btn horizontal right click-to-toggle hide-on-large-only contact-buttons">
                                <a class="btn-floating btn-medium grey waves-effect">
                                    <i class="material-icons">chat</i>
                                </a>
                                <ul>
                                  <?php if (get_field('email_work')) { ?><li><a href="mailto:<?php the_field('email_work'); ?>" target="_blank" title="email" class="email_work btn-floating teal"><i class="material-icons">email</i></a></li><?php } ?>
                                  <?php if (get_field('email_personal')) { ?><li><a href="mailto:<?php the_field('email_personal'); ?>" target="_blank" title="email" class="email-personal btn-floating yellow"><i class="material-icons">mail_outline</i></a></li><?php } ?>
                                  <?php if (get_field('office')) { ?><li><a href="tel:<?php the_field('office'); ?>" title="office" class="office btn-floating blue"><i class="material-icons">phone</i></a></li><?php } ?>
                                  <?php if (get_field('mobile')) { ?><li><a href="tel:<?php the_field('mobile'); ?>" title="mobile" class="mobile btn-floating violet"><i class="material-icons">stay_current_portrait</i></a></li><?php } ?>
                                  
                                </ul>
                              </div>
                            <span class="publications"><?php
                                $term_list = wp_get_post_terms($post->ID, 'publications', array("fields" => "all"));
                                echo $term_list[0]->name;
                                ?></span>
                            <span class="city"><?php
                                $term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
                                echo $term_list[0]->name;
                                ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
                    <?php
//                    global $wp_query;
//                    $big = 999999999; // need an unlikely integer
//                    echo paginate_links(array(
//                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//                        'format' => '?paged=%#%',
//                        'current' => max(1, get_query_var('paged')),
//                        'total' => $wp_query->max_num_pages
//                    ));
                    //echo custom_pagination();
                    ?>
            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </section>
<?php //get_sidebar();    ?>
<?php get_footer(); ?>