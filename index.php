<?php get_header(); ?>
<div class="page-body blog-body">
	<div class="contained">
		<div class="row">
			<div class="article-header">
				<h1 class="page-title">Articles</h1>
			</div><!--logo-area-->
			<div class="archives-body"  role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="past-issue" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<div class="article-inner">
							<?php

							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

							<?php if ($image) : ?>
							<div class="archives-thumb">
							    <img src="<?php echo $image[0]; ?>" alt="hero image" />
							</div>
							<?php endif;?>

						<header class="article-header">
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<span class="author-by">by</span>
							<p class="author-name"><?php the_author(); ?></p>
						</header>
					</div><!-- article-inner -->

				</article>

				<?php endwhile; ?>

						<?php bones_page_navi(); ?>

				<?php else : ?>

						<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
							</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
							</footer>
						</article>

				<?php endif; ?>


			<!-- </main> -->
			</div>


		</div><!--row-->
	</div><!--contained-->
</div><!--page-body-->


<?php get_footer(); ?>
