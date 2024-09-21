<?php
/*
* Template Name: Home Template
*/
?>
<head>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>

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

          <section class="section-writing">
            <?php 
            $ogp = get_blog_urls();
            if(!empty($ogp)) :
            ?>
              <div class="blog-swiper">
                <?php foreach($ogp as $url => $ogp_array) : ?>
                    <a href="<?= $url ?>" class="blog-card">
                    <article>
                      <img src="<?= $ogp_array['image'] ?>" alt="article thumbnail image" width="360" height="200">
                      <div class="blog-card-content">
                        <p class="blog-card-title"><?= $ogp_array['title'] ?></p>
                        <p class="blog-card-description"><?= $ogp_array['description'] ?></p>
                        <?php
                        if (!empty($ogp_array['published_time'])) :
                        $date = new DateTime($ogp_array['published_time']);
                        $formattedDate = $date->format('F j, Y');
                        ?>
                          <p class="blog-card-date"><?= $formattedDatez ?></p>
                        <?php endif; ?>
                      </div>
                    </article>
                    </a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </section>
        </div>
      </article>
    <?php else : ?>
      <p>Sorry, no page content was found!</p>
    <?php endif; ?>
  </section><?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
