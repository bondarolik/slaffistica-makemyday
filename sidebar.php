<!-- sidebar starts -->
<section class="sidebar">
<nav>
	<ul>
		<li id="home"><a href="http://www.slaff.net/blog/">Главная</a></li>
		<li id="about"><a href="http://www.slaff.net/blog/colophon/ru">Об авторе</a></li>
		<li id="arhivces"><a href="http://www.slaff.net/blog/archives">Архивы блога</a></li>
		<li id="blogkey"><a href="http://www.slaff.net/blog/blog-pod-klyuch">Блог под ключ</a></li>
		<li id="feedback"><a href="http://www.slaff.net/blog/feedback">Обратная связь</a></li>
	</ul>

	<h2>Оглавление блога</h2>
	<ul>
		<li id="projects"><a href="http://www.slaff.net/blog/#">Мои проекты</a></li>
		<li id="applepie"><a href="http://www.slaff.net/blog/applepie">Рубрика "Яблочный пирог"</a></li>
		<li id="argentina"><a href="http://www.slaff.net/blog/argentina/">Записи об Аргентине</a></li>
		<li id="chile"><a href="http://www.slaff.net/blog/chile">Записи о Чили</a></li>
		<li id="wordpress"><a href="http://www.slaff.net/blog/wordpress/">WordPress</a></li>
	</ul>
	
	<h2>Экспедиция "Чили вдоль и поперек"</h2>
	<ul>
	<?php
	$args = array(
			'post_type' => 'any',
			'meta_key' => 'my_projects_value',
			'meta_value' => 'chilentero',
			'numberposts' => -1,
			'orderby' => 'date',
			'order' => 'ASC'
		);
	$projects = get_posts($args);	
	foreach ($projects as $post) {
		setup_postdata($post);
	?>
	<li><?php the_date('d/m/Y', '<span>', '</span>'); ?> <a href="<?php the_permalink(); ?>" title="Перейти к прочтению '<?php the_title(); ?>'"><?php the_title(); ?></a></li>
	<?php	} # foreach ?>	
	</ul>	

	<?php if ( is_page(array(2660,2661,2664,2665,2666,2691)) ) : ?>
	<h2>Каталог фотографий</h2>
	<ul>
	<?php wp_list_pages('child_of=2660&title_li='); ?>
	</ul>
	<?php endif; # post 2660,2661,2664,2665,2666,2691 ?>
</nav>

<?php /* If this is the frontpage */
  if ( (is_home()) && !(is_page()) && !(is_single()) && !(is_search()) && !(is_archive()) && !(is_author()) && !(is_category()) && !(is_paged()) ): ?>
<?php endif; #frontpage ?>

</section> <!-- section.sidebar -->	
<!-- sidebar ends -->
