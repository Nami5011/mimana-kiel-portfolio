<?php
/*
* Template Name: Home Template
*/
?>
<?php get_header(); ?>
<main class="wrap">
  <section class="content-area content-thin">
    <?php if ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article class="article-full">
        <header class="home-header">
          <h1><?php the_title(); ?></h1>
        </header>
        <div class="home-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php else : ?>
      <p>Sorry, no page content was found!</p>
    <?php endif; ?>
  </section><?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
