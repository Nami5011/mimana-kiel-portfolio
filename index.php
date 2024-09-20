<?php get_header(); ?>

<main class="wrap">
  <section class="content-area content-thin">
    <?php if ( have_posts() ) : ?>
      <?php the_post(); ?>
      <header class="index-header">
        <h1><?php the_title(); ?></h1>
      </header>
      <div class="index-content">
        <?php the_content(); ?>
      </div>
    <?php else : ?>
      <p>Sorry, no posts were found!</p>
    <?php endif; ?>
  </section><?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
