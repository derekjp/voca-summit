<?php
/*
 Template Name: Homepage
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
<div class="page-body">
	<div class="contained">
		<div class="row">
			<?php include("library/partials/logo.php"); ?>
			<h1 class="screen-reader-text"><?php the_title(); ?></h1>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="homepage-hero" role="main">
			  <?php $videoHeroEntry = get_post_meta( get_the_ID(), 'videoHerovideo', true ); ?>
			  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
			  <?php if ($videoHeroEntry) : ?>
			    <div class="homepage-hero--image">
			      <video playsinline="" autoplay="" muted="" loop="" class="hero-vid">
			        <source src="<?php echo esc_html( $videoHeroEntry ); ?>" type="video/mp4">
			        Your browser does not support HTML5 video.
			      </video>
			    </div>
					<div class="homepage-text">
						<?php the_field('homepage_box_text'); ?>
					</div>
			  <?php elseif ($image) : ?>
					<div class="homepage-hero--image">
							<?php the_post_thumbnail('full'); ?>
					</div>
					<div class="homepage-text">
						<?php the_field('homepage_box_text'); ?>
					</div>
			  <?php else :  ?>

			  <?php endif;?>
			</div>

			<div class="homepage-body">
				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div>
		<?php endwhile; else : ?>
		<?php endif; ?>
		</div><!--row-->
	</div><!--contained-->
</div><!--page-body-->
<?php get_footer(); ?>


<div id="homepage-overlay" class="triggered-area">

	<div class="homepage-overlay--text">
		<?php
		    // query for the about page
		    $your_query = new WP_Query( 'pagename=about' );
		    // "loop" through query (even though it's just one page)
		    while ( $your_query->have_posts() ) : $your_query->the_post();
		        the_content();
		    endwhile;
		    // reset post data (important!)
		    wp_reset_postdata();
		?>

		<span class="overlay-close-button close-button">Home</span>
	</div>
</div>
