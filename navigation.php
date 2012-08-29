<section id="navigation">
<?php if (is_single()) { ?>
	<?php if ( is_attachment() ): ?>
	<div class="alignleft"><?php previous_image_link() ?></div>
	<div class="alignright"><?php next_image_link() ?></div>	
	<?php else: ?>
	<div class="alignleft"><?php previous_post_link(); ?></div>
	<div class="alignright"><?php next_post_link(); ?></div>
	<?php endif; ?>
		<div class="clear"></div>
<?php } else { ?>
<?php
# hook from
# http://iskariot.ru/development/own-pagenavi/
# thanks a lot, dude!
# no more server overloads with wp-pageNavi

global $wp_query;
$max_page = $wp_query->max_num_pages;
$nump=10;

if($max_page!=1){
	$paged = intval(get_query_var('paged'));
	if(empty($paged) || $paged == 0) $paged = 1;

	echo '<p class="pagenavi">';

	if($paged!=1) echo '<a href="'.get_pagenum_link(1).'">К началу</a> ';
		else echo '<span class="current">Первая</span> ';

	if($paged-$nump>1) $start=$paged-$nump; else $start=2;
	if($paged+$nump<$max_page) $end=$paged+$nump; else $end=$max_page-1;

	if($start>2) echo '<span class="currentalt">...</span>';

	for ($i=$start;$i<=$end;$i++)
	 {
	 if($paged!=$i) echo '<a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
		else echo '<span class="current">'.$i.'</span> ';
	 }

	if($end<$max_page-1) echo '<span class="currentalt">...</span>';

	if($paged!=$max_page) echo '<a href="'.get_pagenum_link($max_page).'">К концу</a>';
		else echo '<span class="current">Последняя</span> ';

	echo '</p>
	<div class="clear"></div>'	;
	}
?>
<?php } ?>
</section>