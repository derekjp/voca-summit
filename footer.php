		<footer id="footer" class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
			<div class="container">
				<div id="pre-footer">
					<div class="row">
						<div class="left-pre-footer">
							<h5 class="pre-footer--title"><?php echo get_theme_mod('footer_left_title'); ?></h5>
							<p><?php echo get_theme_mod('footer_left_text'); ?></p>
						</div>
						<div class="center-pre-footer">
							<h5 class="pre-footer--title"><?php echo get_theme_mod('footer_center_title'); ?></h5>
							<p><?php echo get_theme_mod('footer_center_text'); ?></p>
						</div>
						<div class="right-pre-footer">
							<h5 class="pre-footer--title"><?php echo get_theme_mod('footer_right_title'); ?></h5>
							<p><?php echo get_theme_mod('footer_right_text'); ?></p>
						</div>
					</div>
				</div><!--inner-footer-->
				<div id="inner-footer">
					<div class="row">
						<div class="left-footer">
							<p class="source-org copyright">Copyright <?php echo date('Y'); ?> Voices in Contemporary Art.</p>
						</div>
						<div class="right-footer">
							<?php include("social-links.php"); ?>
						</div>
					</div>

				</div><!--inner-footer-->
			</div><!--container-->
		</footer>
		<p class="to-top"><a class="top-link">Back to Top &Hat;</a></p>

		<?php include("nav-mobile.php"); ?>



		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>





	</body>

</html>
