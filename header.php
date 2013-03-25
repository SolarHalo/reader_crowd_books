<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<div id="container">
	<div id="header" class="fl">
    	<a href="<?php get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" class="indexlogo fl" /></a>
        <form>
        	<ul class="login">
            	<li><b>Username</b></li>
                <li><input type="text" class="input1" /><br />
					Register
                </li>
                <li>&nbsp;&nbsp;<b>Password</b></li>
                <li><input type="password" class="input1" /><br />
					Forgot
                </li>
                <li><input type="button" class="input2" value="log in" /></li>
            </ul>
            <div class="searchform">
            	<span><input type="text" class="search"/></span><input type="button" class="input2" value="Search" />
            </div>
            <span class="write"><a href="<?php echo site_url(); ?>/wp-admin/post-new.php">write</a></span>
        </form>
        <ul class="nav">  
        		<?php wp_nav_menu( array('container' => false,"depth"=>1)); ?>
        		
        </ul> 
       
        <!--  <ul class="nav">  
        	<li><a href="#">All Books</a></li>
            <li><a href="#">Forum</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Writers'Wiki</a></li>
            <li><a href="#">About</a></li>
        </ul>  -->
    </div>