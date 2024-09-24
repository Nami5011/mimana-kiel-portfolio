<?php
/*
* Template Name: Home Template
*/
?>

<?php get_header(); ?>
<main class="wrap home">
  <section class="content-area content-thin">
    <?php if ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article class="article-full">
        <header class="home-header">
        </header>
        <div class="home-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endif; ?>
  </section><?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
