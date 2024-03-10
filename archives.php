<?php
/*
 Template Name: Archives
 *
*/
?>
<?php get_header(); ?>

<div class="page-body">
	<div class="contained">
		

			<div class="article-header">
				<h1 class="page-title">Archives</h1>
			</div>
				<header class="article-header entry-header">
					<h1 class="entry-title single-title archives-title"><?php the_field('archives_page_title'); ?></h1>
				</header>
			
			<div class="archive-body"  role="main">
	

				

				<?php

					/*
					*  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
					*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
					*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
					*/

					$post_objects = get_field('page_links');
					

					if( $post_objects ): ?>
					    
					    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					    	

					    	<article class="past-issue" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					    		<a href="<?php the_permalink(); ?>">
							        <div class="archives-thumb">	
										<?php

										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>

										<?php if ($image) : ?>
										    <img src="<?php echo $image[0]; ?>" alt="hero image" />
										
										<?php else :  ?>
											<img src="<?php echo get_template_directory_uri(); ?>/library/images/placeholder-hero.jpg" alt="placeholder image" />
										<?php endif;?> 
									</div><!--archives-thumb-->
							        <header class="article-header">
										<h2 class="entry-title past-issue-title"><span class="main-title serif"><?php the_title(); ?></span></h2>
									</header>
									</a>
					        </article>



					    <?php endforeach; ?>
					    
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif;

					

					?>
				

				 

				



			<!-- </main> -->
			</div>



	</div><!--contained-->
</div><!--page-body-->


<?php get_footer(); ?>

