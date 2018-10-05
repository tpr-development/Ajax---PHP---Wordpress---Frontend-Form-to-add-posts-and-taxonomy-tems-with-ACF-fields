<tr>
  <td>
    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
    <span class="author">Submitted by - <?php the_author(); ?></span>
  </td>
  <td><?php the_time('F j, Y') ?></td>
  <?php
  $verticals = get_terms( array(
    'taxonomy' => 'vertical',
    'hide_empty' => false,
  ) );
  ?>
  <td><?php echo $verticals[0]->name ?></td>
  <?php
  $clients = get_terms( array(
    'taxonomy' => 'client',
    'hide_empty' => false,
  ) );
  ?>
  <td><?php echo $clients[0]->name; ?></td>
  <?php
  $vendors = get_terms( array(
    'taxonomy' => 'vendor',
    'hide_empty' => false,
  ) );
  ?>
  <td><?php echo $vendors[0]->name; ?></td>
  <td><?php the_field('order_status'); ?></td>
</tr>
