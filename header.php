<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="apple-mobile-web-app-title" content="VoCA">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="description" content="<?php bloginfo('description'); ?>" />

		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->

		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">

		<!--  Open Graph Meta -->
		<meta property="og:type" content="website" />
    <meta property="og:title" content="<?php wp_title(''); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/library/images/screenshot.png">
    <meta property="og:url" content="http://summit.voca.network">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:site_name" content="<?php wp_title(''); ?>">
    <meta name="twitter:image:alt" content="<?php wp_title(''); ?>">
    <meta name="twitter:site" content="@voca_network">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>
	<body <?php body_class(); ?> >
		<?php
			$banner = get_theme_mod('banner_is_active');
			if ($banner != ''){?>
				<div class="per-header-banner <?php echo get_theme_mod('banner_color'); ?>">
					<p><?php echo get_theme_mod('banner_text'); ?></p> <span class="per-header-banner--link"><a href="<?php echo get_theme_mod('banner_link_url'); ?>" alt="<?php echo get_theme_mod('banner_link_text'); ?>"><?php echo get_theme_mod('banner_link_text'); ?></a></span>
				</div>
			<?php }
		?>

		<?php include("library/partials/header.php"); ?>
