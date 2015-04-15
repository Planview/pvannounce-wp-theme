<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package PV PP Announcement Webcast
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<!-- use "theme-invert" class on bright backgrounds, also try "text-shadows" class -->
<body <?php body_class(); ?>>

<nav class="mainmenu">
	<div class="container">
		<div class="dropdown">
			<button type="button" class="navbar-toggle" data-toggle="dropdown"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<!-- <a data-toggle="dropdown" href="#">Dropdown trigger</a> -->
			<?php    /**
				* Displays a navigation menu
				* @param array $args Arguments
				*/
				$ppannounce_menu_args = array(
					'theme_location' => is_user_logged_in() ? 'logged-in' : 'logged-out',
					'container' => false,
					'menu_class' => 'dropdown-menu',
					'echo' => true,
					'fallback_cb' => false,
					'depth' => 1,
				);
			
				wp_nav_menu( $ppannounce_menu_args ); ?>
		</div>
	</div>
</nav>