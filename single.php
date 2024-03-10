<?php get_header(); ?>
<div class="page-body">
	<div class="contained">
		<div class="row">
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
							<?php if ($image) : ?>
							<div class="article-hero">
							    <img src="<?php echo $image[0]; ?>" alt="hero image" />
							</div><!--article-hero-->
						<?php endif;?>
						<article class="article-content single-content">
							<?php
								get_template_part( 'post-formats/format', get_post_format() );
							?>
							<?php endwhile; ?>
							<?php else : ?>
								<div id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
								</div>
							<?php endif; ?>
						</article>
						<?php if( get_field('about_author') ): ?>
							<article class="article-content">
								<div class="article-body about_author">
									<div class="row">
										<div class="author-text">
											<p class="about-text"><?php the_field('about_author'); ?></p>
										</div>
									</div>
								</div>
							</article>
						<?php endif; ?>
					</main>
				</div>
			</div>
		</div><!--row-->
	</div><!--contained-->
</div><!--page-body-->

<?php get_footer(); ?>
