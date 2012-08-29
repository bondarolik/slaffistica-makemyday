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
	<link rel="stylesheet" href="/libs/fancybox/jquery.fancybox-1.3.4.css" />

	<script src="/libs/js/jquery-latest.js"></script>
	<script src='/libs/aviaslider/jquery.aviaSlider.min.js'></script>
	<!--[if IE]>
		<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->	
	<?php	if (is_singular()) wp_print_scripts('comment-reply'); ?>	
	<script src="/libs/fancybox/jquery.fancybox-1.3.4.pack.js"></script>	
	<? /* <script src="/libs/fancybox/jquery.easing-1.3.pack.js"></script> */ ?>
	<script src="/libs/js/calls.js"></script>
	<script src="<?php bloginfo('url') ?>/wp-content/plugins/daves-wordpress-live-search/jquery.dimensions.pack.js?ver=3.0.1"></script>
	<script src="<?php bloginfo('url') ?>/wp-content/plugins/daves-wordpress-live-search/daves-wordpress-live-search.js.php?ver=3.0.1"></script>
	<link rel="stylesheet" href="<?php bloginfo('url') ?>/wp-content/plugins/daves-wordpress-live-search/daves-wordpress-live-search_default_gray.css?ver=3.0.1" />
	<script src="<?php bloginfo('url') ?>/wp-includes/js/swfobject.js?ver=2.2"></script>	
	<!-- Vipers Video Quicktags v6.3.0 | http://www.viper007bond.com/wordpress-plugins/vipers-video-quicktags/ -->
	<style type="text/css">
	.vvqbox { display: block; max-width: 100%; visibility: visible !important; margin: 10px auto; } 
	.vvqbox img { max-width: 100%; height: 100%; } 
	.vvqbox object { max-width: 100%; } 
	</style>
	<script type="text/javascript">
	// <![CDATA[
		var vvqflashvars = {};
		var vvqparams = { wmode: "opaque", allowfullscreen: "true", allowscriptaccess: "always" };
		var vvqattributes = {};
		var vvqexpressinstall = "http://www.slaff.net/blog/wp-content/plugins/vipers-video-quicktags/resources/expressinstall.swf";
	// ]]>
	</script>
		
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
	<meta name='copyright' content='&copy; Вячеслав Бондарук. Slaffistica Media Studio' />

	<meta name="verify-v1" content="D9DQKQ06MlNxd+gWv+l1jOdmhqPvcW6r4VLm2JHH7Lc=" />
	<meta name="google-site-verification" content="0Q7keW5ssc5uVVxu0YxABSH8Miu3FjZ4k5VdmQFYOno" />
	<meta name="webmoney.attestation.label" content="webmoney attestation label#24511A97-0BCF-4C91-9FC1-F72D486A96B5" /> 
	<meta name="msvalidate.01" content="92080B5AA64C7A5C06F8AFBA0F95F1CE" />
	<meta content='890ab442' name='verification-key' />

	<link rel="index" href="http://www.slaff.net/">
	<link rel="alternate" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="rsd" type="application/rsd+xml" href="<?php bloginfo('url') ?>/xmlrpc.php?rsd" />
	
	<?php if (is_page()) { wp_head(); } ?>
	<?php
	// this code is not very userful, it generates archives links
	// if you need 'em , just uncomment it
	//wp_get_archives('type=monthly&format=link'); ?>
</head>

<body>
<div id="slaffistica">
<section class="leftcolumn">
	<header>
		<a class="logo" href="http://www.slaff.net/blog" title="Slaff.net - всякая фигня про южную америку на личном опыте"></a>
		
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</header>
