<?php
load_theme_textdomain('slaffistica');
$options = get_option('slaffistica_options');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php wp_title(); ?></title>
	
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold&subset=cyrillic' />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic&subset=cyrillic' />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />

	<script src="/libs/js/jquery-latest.js"></script>
	<script src='/libs/aviaslider/jquery.aviaSlider.min.js'></script>
	<!--[if IE]>
		<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->	
	<?php	if (is_singular()) wp_print_scripts('comment-reply'); ?>	
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/calls.js"></script>
		
	<?php
	$keywords = "slaff, slaffistica, вячеслав бондарук, фотоэкспедиции, фильмы про чили, русские в чили, чили, иммиграция в чили, фотоблог, русский фотоблог, латинская америка, фотографии чили, экспедиция по чили, туризм в латинской америке, пмж в чили, недвижимость в чили, заработок на блоге, как переехать в чили, женщины в колумбии";

	if (is_home()) { 
		$description = get_bloginfo('description');
	} else if (is_single()) {
		$description =  $post->post_title;
		$tags = wp_get_post_tags($post->ID);

		foreach ($tags as $tag ) {
			$tagslist .= $tag->name . ", ";
		}

		$keywords = $keywords.", ".$tagslist;
	} 
	else if (is_category()) {
		$description = category_description();
	}
	?>
	
	<meta name="robots" content="index,follow" />
	<meta name='keywords' content='<?php echo $keywords; ?>' />
	<meta name='description' content='<?php echo $description; ?>' />
	<meta name='template' content='Slaffistica Make My Day' />
	<meta name='copyright' content='&copy; Lipresso Networks' />

	<link rel="index" href="http://www.slaff.net/">
	<link rel="alternate" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="rsd" type="application/rsd+xml" href="<?php bloginfo('url') ?>/xmlrpc.php?rsd" />
	
	<?php wp_head(); ?>
	<?php
	// this code is not very userful, it generates archives links
	// if you need 'em , just uncomment it
	//wp_get_archives('type=monthly&format=link'); ?>
</head>

<body>
<div id="slaffistica">
<section class="leftcolumn">
	<header>
		<a class="logo" href="<? phpbloginfo('url') ?>" title="<? phpbloginfo('description') ?>"></a>
		
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</header>
