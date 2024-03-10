<?php if (is_front_page()) : ?>
	<header id="header" class="home-header">
		<div class="header-main">
			<div class="contained">
				<div class="header-main-inner">
					<div class="header-main-left">
						<div class="logo-long">
							<a href="http://voca.network" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/VoCA-logo.png" title="VoCA Logo" alt="VoCA Logo"></a>
						</div>
						<div class="logo-square">
							<a href="http://voca.network" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/VoCA-Square.png" title="VoCA Logo" alt="VoCA Logo"></a>
						</div>
					</div><!--header-main-left-->
					<div class="header-main-right">
						<?php include("nav-simple.php"); ?>
					</div><!--header-main-right-->
				</div><!--header-inner-->
			</div><!--contained-->
		</div><!--main-header-->
	</header>


<?php else :  ?>
	<header id="header" class="internal-header">
		<div class="header-main">
			<div class="contained">
				<div class="header-main-inner">
					<div class="header-main-left">
						<div class="logo-long">
							<a href="http://voca.network" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/VoCA-logo.png" title="VoCA Logo" alt="VoCA Logo"></a>
						</div>
						<div class="logo-square">
							<a href="http://voca.network" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/VoCA-Square.png" title="VoCA Logo" alt="VoCA Logo"></a>
						</div>
					</div><!--header-main-left-->
					<div class="header-main-center">
						<div class="internal-logo">
							<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/summit-logo.png" title="VoCA Journal Logo" alt="VoCA Journal Logo"></a>
						</div>
					</div>
					<div class="header-main-right">
						<?php include("nav-simple.php"); ?>
					</div><!--header-main-right-->
				</div><!--header-inner-->
			</div><!--contained-->
		</div><!--main-header-->
	</header>
<?php endif;?>
