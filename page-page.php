<?php
/*
* Template Name: Page Template
*/
?>
<?php get_header(); ?>
<main class="wrap page">
  <section class="content-area content-thin">
    <?php if ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article class="article-full">
        <header class="page-header">
          <p class="breadcrumbs"><a href="<?= get_site_url(); ?>">top</a> / <?php the_title(); ?></p>
        </header>
        <div class="page-content">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </article>
    <?php else : ?>
      <p>Sorry, no page content was found!</p>
    <?php endif; ?>
  </section><?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
