<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="keywords" content="">
<!--[if lt IE 9]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css">
<?php wp_head(); ?>
</head>

<body>
<div id="header_wrap">
	<header>
		<div id="logo">
			<h1>
				<a href="<?php get_site_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Reader Crowd logo">
				</a>
			</h1>
		</div>

		<!-- login -->
		<?php the_widget(
			'Theme_My_Login_Widget',
			array(
				'default_action' => 'login',
				'logged_in_widget' => 1,
				'show_title' => 1,
				'show_log_link' => 1,
				'show_reg_link' => 1,
				'show_pass_link' => 1,
				'show_gravatar' => 1,
				'gravatar_size' => 50,
				'register_widget' => 1,
				'lostpassword_widget' => 1
			),
			array(
				'before_title' => '<span>',
				'after_title' => '</span>',
				'before_widget' => '<div id="login_wrap">',
				'after_widget' => '</div>'
			));
		?>
		<a id="new_post" href="<?php echo site_url(); ?>/wp-admin/post-new.php">Write</a>
	</header>
</div>

<div id="nav_wrap">
	<nav>
		<?php wp_nav_menu('menu_class=nav_menu'); ?>

		<!-- search_form -->
		<form id="search_form" method="get" action="<?php echo home_url(); ?>" >
			<input type="text" id="search_input" name="s" value="" placeholder="Search...">
		</form>
	</nav>
</div>