<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="container">
	<div id="header" class="fl">
	 
    	<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" class="indexlogo fl" /></a>
    	
    	<?php
    	 $current_user = wp_get_current_user();
    	 if( 0 == $current_user->ID) {?> 
    	 
       <form name="loginform" id="loginform1" action="/?page_id=4&action=login&instance=1" method="post">
        	<ul class="login2">
            	<li><b>Username</b> <br />
                 <input type="text" class="input1"  name="log" id="user_login1"  tabIndex=1/><br />
					<a href="?page_id=4&action=register">Register</a>
                </li>
                <li><b>Password</b> <br />
                <input type="password" name="pwd" id="user_pass1"  class="input1" tabIndex=2 /><br />
					<a href="?page_id=4&action=lostpassword">Forgot</a>
                </li>
                <li><input type="submit" name="wp-submit" id="wp-submit1" class="input2" value="log in"  style="margin-top:25px;"/></li>
            </ul>
             <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />
			<input type="hidden" name="testcookie" value="1" />
			<input type="hidden" name="instance" value="1" />
        </form> 
        <?php }else{?>
        	<!-- <ul class="login">
        	 <li>       welcome  <b><?php echo $current_user->user_login; ?></b> </li>
        	 <li><a href="<?php get_site_url(); ?>/wp-admin">Dashboard</a></li>
        	 <li><a href="?page_id=4&action=profile">Profile</a></li>
        	 <li><a href="<?php get_site_url(); ?>/wp-admin"><?php echo$current_user->user_login; ?> Dashboard</a></li>
        	 <li><a href="<?php echo wp_logout_url(); ?>">Login out</a></li>
        	 </ul> -->
        	 <ul class="userlogin">
        	 <?php 
        	    $userpoto = getUserPotoPath($current_user->ID);
        	 ?>
            	<li><img src="<?php echo $userpoto;?>"  width="43" height="43"/></li>
              	 <li><a href="?page_id=4&action=profile"><?php echo$current_user->user_login; ?> Dashboard</a></li>
                 <li class="active"><a href="<?php get_site_url(); ?>/?page_id=517">My Book</a></li> 
                <li><a href="<?php echo wp_logout_url(); ?>">Log Out</a></li>  
            </ul>
       <?php }?> 
            <div class="searchform">
            		<form id="search_form" method="get" action="<?php echo home_url(); ?>" >
            
            	<span><input type="text"  id="search_input"   name="s" value="" class="search"/></span><input type="submit" class="input2" value="Search" />
            	</form>
            </div>
            <span class="write"><a href="<?php get_site_url(); ?>/?page_id=522">write</a></span>
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