<?php /* Initialize The Loop */ if (have_posts()) :  ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<h3 class="pagetitle">Просмотр архивов в категории: &#8216;<?php single_cat_title(); ?>&#8217;</h3>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
<h3 class="pagetitle">Журнал Латинская Америка</h3>
<h3 class="pagetitle">Просмотр архивов по тагу: &#8216;<?php single_tag_title(); ?>&#8217;</h3>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h3 class="pagetitle">Архивы за <?php the_time('F jS, Y'); ?></h3>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h3 class="pagetitle">Архивы за <?php the_time('F, Y'); ?></h3>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h3 class="pagetitle">Архивы за <?php the_time('Y'); ?></h3>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h3 class="pagetitle">Архив автора</h3>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h3 class="pagetitle">Архивы блога</h3>
<?php } ?>

<?php /* Start The Loop */ while (have_posts()) : the_post(); ?>
<?php
if (in_category('2207')) {
	$cf_values = array();
	$get_cf_extname = get_post_custom_values('ext_source_name');
	foreach ($get_cf_extname as $key => $value): $cf_values['extname'] = $value; endforeach;
	$get_cf_extlink = get_post_custom_values('external_source');
	foreach ($get_cf_extlink as $key => $value): $cf_values['extlink'] = $value; endforeach;
}

# prepare changes and special tags
$key = "my_projects_value"; 
$themeta = get_post_meta($post->ID, $key, true);
?>	
<article>
	<section class="meta">
		<time datetime="<?php the_time('c'); ?>" pubdate>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
				<span class="day"><?php the_time('j'); ?></span>
				<span class="month"><?php the_time('M'); ?></span>
			</a>	
		</time>
		<?php # if (function_exists('tweetmeme')): echo tweetmeme(); endif; ?>
	</section>
	
	<section class="content">
	<?php if (in_category('2207')): ?>
	<?php if (is_single()) : ?>
		<h1>Ссылка: <a href="<?php echo $cf_values['extlink']; ?>" rel="nofollow" title="<?php the_title(); ?> , <?php echo $cf_values['extname']; ?>"><?php the_title(); ?></a></h1>		
	<?php else: ?>
		<h2>Ссылка: <a href="<?php echo $cf_values['extlink']; ?>" rel="nofollow" title="<?php the_title(); ?> , <?php echo $cf_values['extname']; ?>"><?php the_title(); ?></a></h2>
	<?php endif; ?>
<?php elseif ($themeta == 'chilefaq'): ?>	
	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">Иммиграция в Чили: <?php the_title(); ?></a></h1>
	<?php elseif ($themeta == 'freewalls'): ?>	
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">Бесплатный валлпапер: <?php the_title(); ?></a></h1>
	<?php elseif ($themeta == 'chilentero'): ?>	
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">Чили вдоль и поперек: <?php the_title(); ?></a></h1>
	<?php elseif ( is_attachment() ): ?>
		<h1><a href="<?php echo get_permalink($post->post_parent); ?>" rel="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h1>	
	<?php else: ?>
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	<?php endif; # category check ?>

	<?php if ( is_search() ) { ?>
		<?php the_excerpt(); ?>		
	<?php } else { ?>
		<?php the_content('Продолжить чтение ...'); ?>	
		
		<?php
		# special case for attachments page
		if ( is_attachment() ) {
			if ( is_single() ) {
			
			$attachments = get_my_attachments(get_the_ID());
			if ($attachments) {
				foreach ($attachments as $att) {
					if (wp_attachment_is_image($att->ID)) {
						$image = get_the_image($att->ID, 'medium');
						# code split
		?>
			<div class="imagebox">			
			<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" class="" />
			<?php if ($image['caption'] != "") { ?>
				<p><?php echo $image['caption']; ?> (<?php echo $image['description'] ?>)</p>
			<?php } else { ?>
				<p><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></p>
			<?php } ?>	
			</div>
			<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>	
			<?php 
					} # if image
				} # foreach
			} # if attachments
			
			# on other pages show post thumbnail if there is one
			} else {
				if ( has_post_thumbnail() ) { the_post_thumbnail(); }
			}
		} # is_attachment() 
		?>
	<?php } // else search or other page ?>	

	<?php if (in_category('2207')) { ?>
		<p class="ext_source_name"><?php echo $cf_values['extname']; ?></p>
	<?php } ?>
	
	<?php # if (function_exists('Short_Button')) { echo Short_Button(); } ?>
	
	<?php if (is_single() || is_page()) { ?>
		<?php link_pages('<p><strong>Страницы:</strong>', '</p>', 'number'); ?>
		<?php edit_post_link('Редактировать', '<h3 class="editlink">&nbsp;&nbsp;', '</h3>'); ?>		
	<?php } ?>
	
	<?php
		# code to include separate page with banners in single pages
		if (is_single() || is_page() || is_attachment()) {
			#no file installed. install the file before use it
			#include (TEMPLATEPATH . '/includes/single468x60.php');
		}
	?>

	<?php
	if (is_single()) {
		$checkpostID = $post->ID;
		$meta = get_post_meta($post->ID, 'my_projects_value', true);
		# if there are similar posts
		if ($meta != '') {
			$args = array(
					'post_type' => 'any',
					'meta_key' => 'my_projects_value',
					'meta_value' => $meta,
					'numberposts' => -1,
					//'exclude' => $post->ID
					'orderby' => 'date',
					'order' => 'ASC'
				);
			$projects = get_posts($args);		
	?>
	<nav class="similarposts">
	<h3>Записи из этой рубрики:</h3>
		<ul>		
		<?php
		foreach ($projects as $post) {
			setup_postdata($post);
			?>
			<li><?php the_date('d/m/Y', '<span>', '</span>'); ?> <a href="<?php the_permalink(); ?>" title="Перейти к прочтению '<?php the_title(); ?>'"><?php the_title(); ?></a> 
				<?php if ($checkpostID == $post->ID) { echo "(Вы сейчас читаете эту запись)"; } ?>
			</li>
		<?php	} # foreach ?>
		</ul>
	</nav>
	<?php } # if $meta (my_projects_value) ?>	
	
	<?php if (is_singular()): ?>
	<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
	<script type="text/javascript">
	new Ya.share({
		elementID: 'ya_share1',
		style: {
			'button': true,
			'link': true,
			'icon': true,
			'border': false
		},
		services: ['yaru', 'vkontakte', 'facebook', 'twitter', 'lj'],
		popup: {
			input: true
		},
	 });
	</script>
	<div id="ya_share1"></div>
	<?php endif; ?>	
	
	<? /* 
	<p class="singlemetas">
		Запись была опубликована <?php the_time('F jS, Y') ?> в категории(ях) "<?php the_category(', '); ?>".
	</p>
		*/ ?>
	<?php /* Insert Paged Navigation for Permalinks (has to be inside the loop) */ 
			include (TEMPLATEPATH . '/navigation.php'); ?>
	<?php } // single  ?>
	<!--
		<?php trackback_rdf(); ?>
	-->	
	</section>
	<div class="separator"></div>
</article> 
<?php endwhile; # end of loop ?>

<?php /* Insert Paged Navigation */ 
	if ( (is_home() or is_archive()) or (is_search()) or (is_paged()) or (is_category()) ) { 
		include (TEMPLATEPATH . '/navigation.php'); 
	}
?>

<?php else: ?>

	<article>
		<p>По вашему запросу ничего не найдено. Попробуйте изменить запрос или направить персональное сообщение автору.</p>
	</article>

<?php endif; # ( if (have_posts()) ) ?>