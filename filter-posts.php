<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$args = array(
    'orderby' => 'date', // we will sort posts by date
    'order' => $_POST['date'], // ASC или DESC
    'posts_per_page' => -1
);

// creating taxonomy arg

$args['tax_query'] = array(
    'relation' => 'AND',
);

// argument for vertical
if(!empty($_POST['vertical'])){
    array_push($args['tax_query'],
        array(
                'taxonomy' => 'vertical',
                'field' => 'slug',
                'terms' => $_POST['vertical']
            )
        );
}
// argument for client
if( !empty($_POST['client'])){
    array_push($args['tax_query'],
        array(
                'taxonomy' => 'client',
                'field' => 'slug',
                'terms' => $_POST['client']
            )
        );
}
// argument for vendor
if( !empty( $_POST['vendor'])){
    array_push($args['tax_query'],
        array(
                'taxonomy' => 'vendor',
                'field' => 'slug',
                'terms' => $_POST['vendor']
            )
        );
}
// argument for pr status
if( !empty( $_POST['status'])){
    $args['meta_key'] = 'order_status';
    $args['meta_value'] = $_POST['status'];
}

// Posts
$posts = new WP_Query($args);
$s = '';
if($posts -> have_posts()): while($posts->have_posts()): $posts->the_post();
  $verticals = get_the_terms($post->ID, 'vertical');
  $clients = get_the_terms($post->ID, 'client');
  $vendors = get_the_terms($post->ID, 'vendor');
  $status = get_field('order_status');
  $s = $s . '<tr>
    <td>
      <h6><a href="'. get_the_permalink().'">'.get_the_title().'</a></h6>
      <span class="author">Submitted by - '.get_the_author().'</span>
    </td>
    <td>'.get_the_time('F j, Y').'</td>
    <td>'.$verticals[0]->name.'</td>
    <td>'.$clients[0]->name.'</td>
    <td>'.$vendors[0]->name.'</td>
    <td>'.$status.'</td>
  </tr>';
  endwhile;
else:
  echo '<h4>There is no PR with this combination, try a different one.</h4>';
endif;
//
// $jsonPost = json_encode($posts);
// echo $jsonPost;
echo $s;
