<?php
/*
 Template Name: Video Page
*/
?>
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


						<!-- Start of Grid - Bottom -->
						<div class="video-page-body">
							<?php
								$textTitle1 = get_post_meta( get_the_ID(), 'titleOnetext', true );
								echo "<div class='video-section--title'><h3>$textTitle1</h3></div>";
							?>
							<!-- CMB2 Video Grid -->
							<div class="row">
								<div class="flex-container">
									<?php $entries = get_post_meta( get_the_ID(), 'video_grid_repeat_group_top', true );
										foreach ( (array) $entries as $key => $entry ) {
											$video_url = $title = $date = $location = $desc = '';
											if ( isset( $entry['video_url'] ) ) {
												$video_url = esc_html( $entry['video_url'] );
											}
											if ( isset( $entry['title'] ) ) {
												$title = esc_html( $entry['title'] );
											}
											if ( isset( $entry['date'] ) ) {
												$date = esc_html( $entry['date'] );
											}
											if ( isset( $entry['location'] ) ) {
												$location = esc_html( $entry['location'] );
											}
											if ( isset( $entry['description'] ) ) {
												$desc = wpautop( $entry['description'] );
											}
											// Do something with the data

											echo "<div class='video-page-block'>
														<div class='video-container'>
														 <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
														 <div class='embed-container'>"
														  . wp_oembed_get( $video_url ) .
														 "</div>
													 </div>
														<div class='video-text'>
															<h5>$title</h5>
															<div class='video-description'>$desc</div>
														</div>
													</div><!--video-page-block-->";
										}
									?>

								</div>
							</div>
						<!-- CMB2 Video Grid End -->



						<!-- CMB2 Video Feature -->
						<?php
							$textTitle2 = get_post_meta( get_the_ID(), 'titleTwotext', true );
							echo "<div class='video-section--title'><h3>$textTitle2</h3></div>";
						?>
							<?php $entries = get_post_meta( get_the_ID(), 'video_feature_repeat_group', true );
								foreach ( (array) $entries as $key => $entry ) {
									$video_url = $title = $date = $location = $desc = '';
									if ( isset( $entry['video_url'] ) ) {
										$video_url = esc_html( $entry['video_url'] );
									}
									if ( isset( $entry['title'] ) ) {
										$title = esc_html( $entry['title'] );
									}
									if ( isset( $entry['date'] ) ) {
										$date = esc_html( $entry['date'] );
									}
									if ( isset( $entry['location'] ) ) {
										$location = esc_html( $entry['location'] );
									}
									if ( isset( $entry['description'] ) ) {
										$desc = wpautop( $entry['description'] );
									}
									// Do something with the data

									echo "<div class='video-page-feature'>
														<div class='video-container'>
														 <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
														 <div class='embed-container'>"
														  . wp_oembed_get( $video_url ) .
														 "</div>
													 </div>
													 <div class='video-text'>
														 <h5>$title</h5>
														 <div class='video-description'>$desc</div>
													 </div>
													</div><!--video-page-block-->";
								}
							?>
							<!-- CMB2 Video Feature End -->


					<!-- Start of Grid - Bottom -->
					<div class="video-page-body video-grid--bottom">

						<?php
							$textTitle3 = get_post_meta( get_the_ID(), 'titleThreetext', true );
							echo "<div class='video-section--title'><h3>$textTitle3</h3></div>";
						?>

						<!-- CMB2 Video Grid -->
						<div class="row">
							<div class="flex-container">
								<?php $entries = get_post_meta( get_the_ID(), 'video_grid_repeat_group_bottom', true );
									foreach ( (array) $entries as $key => $entry ) {
										$video_url = $title = $date = $location = $desc = '';
										if ( isset( $entry['video_url'] ) ) {
											$video_url = esc_html( $entry['video_url'] );
										}
										if ( isset( $entry['title'] ) ) {
											$title = esc_html( $entry['title'] );
										}
										if ( isset( $entry['date'] ) ) {
											$date = esc_html( $entry['date'] );
										}
										if ( isset( $entry['location'] ) ) {
											$location = esc_html( $entry['location'] );
										}
										if ( isset( $entry['description'] ) ) {
											$desc = wpautop( $entry['description'] );
										}
										// Do something with the data

										echo "<div class='video-page-block'>
													<div class='video-container'>
													 <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
													 <div class='embed-container'>"
													  . wp_oembed_get( $video_url ) .
													 "</div>
												 </div>
												 <div class='video-text'>
													 <h5>$title</h5>
													 <div class='video-description'>$desc</div>
												 </div>
												</div><!--video-page-block-->";
									}
								?>

							</div>
						</div>
					<!-- CMB2 Video Grid End -->

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
