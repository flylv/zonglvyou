<?php
$args = array(
'post_type' => 'trip',
'post_status' => 'publish',
'posts_per_page' => -1,
'cat' => get_query_var('cat')
);
$the_query = new WP_Query($args);?>

<?php while ($the_query->have_posts()) :  $the_query->the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>


