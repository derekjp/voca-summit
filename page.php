<?php get_header(); ?>
<div class="page-body">
	<div class="contained">
		<div class="row">


			<main id="main" class="about-page" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php include("library/partials/hero.php"); ?>


				<article  class="article-content" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

					<div class="article-body">

						<section class="entry-content cf" itemprop="articleBody">
							<?php
								// the content (pretty self explanatory huh)
								the_content();

								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>
						</section> <?php // end article section ?>

					</div>
					<div class="back-to-home-button">
						<a href="<?php echo home_url(); ?>" alt="Home">Home</a>
					</div>
				</article>

				<?php endwhile; endif; ?>



			</main>


		</div><!--row-->
	</div><!--contained-->
</div><!--page-body-->

<?php get_footer(); ?>
