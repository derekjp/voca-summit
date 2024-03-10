<div class="summit-page-hero">
  <?php $videoHeroEntry = get_post_meta( get_the_ID(), 'videoHerovideo', true ); ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
  <?php if ($videoHeroEntry) : ?>
    <div class="summit-page-hero--image">
      <video playsinline="" autoplay="" muted="" loop="" class="hero-vid">
        <source src="<?php echo esc_html( $videoHeroEntry ); ?>" type="video/mp4">
        Your browser does not support HTML5 video.
      </video>
      <header class="summit-page-header">
        <div class="summit-page-hero--title">
          <h1><?php the_title(); ?></h1>
        </div>
      </header>
    </div>
  <?php elseif ($image) : ?>
    <div class="summit-page-hero--image">
      <img src="<?php echo $image[0]; ?>" alt="hero image" />
      <header class="summit-page-header">
        <div class="summit-page-hero--title">
          <h1><?php the_title(); ?></h1>
        </div>
      </header>
    </div>
  <?php else :  ?>
    <div class="summit-page-hero--no-image">
      <header class="summit-page-header">
        <div class="summit-page-hero--title">
          <h1><?php the_title(); ?></h1>
        </div>
      </header>
    </div>
  <?php endif;?>
</div>
