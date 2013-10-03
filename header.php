<?php
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8" />
	<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="author" content="Kennedy Osemede,Olanipekun Femi, Ennovate Nigeria" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/base.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/skeleton.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/layout.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/responsive-nav.css" />
    <link href='http://fonts.googleapis.com/css?family=Dosis:500|Open+Sans' rel='stylesheet' type='text/css' />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
    
    
    <!-- Wordpress Header
	================================================== -->
    <?php wp_head(); ?>   
</head>
<body <?php body_class(); ?>>



	<!-- Primary Page Layout
	================================================== -->
<header>
<div class="container">
<div class="logo">
<a href="<?php echo home_url(); //make logo a home link?>">
<figure>
<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" />
</figure>
</a>
</div>
<nav class="offset-by-four">
<div id="nav">
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
</div>
</nav>
<div class="search">
<figure>
<img src="<?php echo get_template_directory_uri(); ?>/images/search_icon.png" class="s_click" />
</figure>
<div class="hidden_form">
<form action="<?php echo home_url('/'); ?>" method="get" enctype="text/plain" name="search" autocomplete="on">
<input type="text" name="s" placeholder="Search..." autocomplete="on" />
<input type="image" name="go" src="<?php echo get_template_directory_uri(); ?>/images/search.png" width="32" height="32" />
</form>
</div>
</div>
</div>

</header>
    
 