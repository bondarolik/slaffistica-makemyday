<!-- sidebar starts -->
<section class="sidebar">
<nav>
	<ul>
		<li id="home"><a href="http://www.slaff.net/blog/">Главная</a></li>
		<li id="about"><a href="http://www.slaff.net/blog/colophon/ru">Об авторе</a></li>
		<li id="arhivces"><a href="http://www.slaff.net/blog/archives">Архивы блога</a></li>
		<li id="services"><a href="http://www.slaff.net/blog/uslugi">Услуги</a></li>
		<li id="inmigration"><a href="http://www.slaff.net/blog/immigratsiya-v-chili">Иммиграция в Чили</a></li>
		<? /* <li id="photostore"><a href="http://www.slaff.net/blog/sale">Фотомагазин</a></li> */ ?>
		<li id="blogkey"><a href="http://www.slaff.net/blog/blog-pod-klyuch">Блог под ключ</a></li>
		<li id="feedback"><a href="http://www.slaff.net/blog/feedback">Обратная связь</a></li>
		<? /* 
		<li><a href="http://www.slaff.net/blog/vash-turisticheskiy-konsultant">Туристические консультации</a></li>
		<li><a href="http://www.slaff.net/blog/?p=2869" title="Весенний фотозамут"><span style="color: red !important; font-weight: bold;">Весенний фотозамут</span></a></li>
		*/ ?>		
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

	<? /* 
	<h2>Со мной на связи</h2>
	<ul>	
		<li><a href="http://www.twitter.com/slaff" title="Slaff в Твиттере">Я в твиттере</a></li>
		<li><a href="http://fusion.google.com/add?feedurl=http://feeds.feedburner.com/slaff">Читать в Google Reader</a></li>
		<li><a href="http://lenta.yandex.ru/settings.xml?name=feed&amp;url=http://feeds.feedburner.com/slaff">Читать в Яндекс.Ленте</a></li>
		<li><a href="http://feeds.feedburner.com/slaff"><img src="http://feeds.feedburner.com/~fc/slaff?bg=FFFFFF&amp;fg=36393D&amp;anim=1" height="26" width="88" alt="Подписаться на обновления блога по RSS" /></a></li>

		<li><a href="<?php bloginfo('rss2_url'); ?>">Записи</a> (RSS)</li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Комментарии</a> (RSS)</li>
	</ul>	
		*/ ?>
<?php /* If this is the frontpage */
  if ( (is_home()) && !(is_page()) && !(is_single()) && !(is_search()) && !(is_archive()) && !(is_author()) && !(is_category()) && !(is_paged()) ): ?>
<?php endif; #frontpage ?>

	<aside class="sponsors">
		<h2>Спонсорские ссылки</h2>
		<p id="tnx">
		<?php
		$cache_dir = '/_tnxcchedir/'; // you MUST insert your folder name instead of "cache"!
		include_once($_SERVER['DOCUMENT_ROOT'] . $cache_dir . 'tnx.php');
		$tnx = new TNX_n('slaff', $cache_dir); // your TNX login
		echo $tnx->show_link(1); // first link
		echo $tnx->show_link(1); // second link
		echo $tnx->show_link(1); // third link
		echo $tnx->show_link(); // remaining links
		?>
		</p>

		<p id="sape">
		<?php
		  if (!defined('_SAPE_USER')) {
		      define('_SAPE_USER', '9aaa6adeea1c7f76a22998aef2db6935');
		  }
		  require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php');
		  $o['charset'] = 'UTF-8';
		  $sape = new SAPE_client($o);
		  #echo $sape->return_links();
			echo $sape->return_block_links();
		  unset($o);
		?>
		</p>
		
		<? /* 
		<p id="setlinks" >
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/blog/setlinks_3f04b/slsimple.php"); ?>
		</p>
		*/ ?>
	</aside>
</section> <!-- section.sidebar -->	
<!-- sidebar ends -->
