<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ("Эта страница не может быть загружена таким образом.");
}
if ( post_password_required() ) {
	echo '<p class="nocomments">Эта запись защищена паролем.<p>';
	return;
}
?>
<? /* 
<h3 id="closed">Куда делись комментарии?</h3>

<p>Если вы хотите обсудить эту запись накоротке или сказать "спасибо", то можете написать мне в <a href="http://twitter.com/#!/slaff">twitter</a> или, если вам действительно есть, что сказать, то отправьте мне <a href="javascript:openMailBox()" id="clicker">сообщение на емэйл</a>.</p>

<section id="mailbox" style="display: none;">
	<form action="javascript:sendFeedback()" id="feedback" method="post" accept-charset="utf-8">
	<p id="message-area" style="display:none;"></p>
	
	<label for="name">Ваше имя:</label> <input type="text" name="name" id="name" value="" />
		<div class="clear"></div>
	<label for="email">Ваш емайл:</label> <input type="text" name="email" id="email" value="" />
		<div class="clear"></div>
	<label for="website">Сайт / Блог:</label> <input type="text" name="website" id="website" value="" />
		<div class="clear"></div>
	<input type="hidden" name="post_name" id="post_name" value="<?php the_title(get_the_ID()); ?>" />
	<input type="hidden" name="post_link" id="post_link" value="<?php the_permalink(get_the_ID()); ?>" />
	<input type="hidden" name="action" id="action" value="commentopionion" />
	
	<input type="submit" name="submit" id="submit" value="Отправить" />
	</form>
</section>
*/ ?>

<?php if ( have_comments() ) : ?>
<?php if ( !empty($comments_by_type['comment']) ) : ?>
<ul>
<?php wp_list_comments('type=comment&callback=slaffistica_comments'); ?>
</ul>
<?php endif; # line 13 ?>

<?php if ( !empty($comments_by_type['pings']) ) : ?>
<h3 id="pings">На эту запись ссылаются:</h3>
<ul>
<?php wp_list_comments('type=pings&callback=list_pings'); ?>
</ul>
<?php endif; # line 19 ?>

<?php else : // this is displayed if there are no comments so far ?>
	<?php
    // If comments are open, but there are no comments.
    if ('open' == $post->comment_status) : ?>
    <h3 id="nocomments">Пока еще никто не оставлял комментариев к этой записи.</h3>
	<?php else : // comments are closed ?>
    <h3 id="closed">Обсуждение закрыто.</h3>
    <?php endif; ?>
<?php endif; ?>

<?php include (TEMPLATEPATH.'/form.comments.php'); ?>
<?php #comment_form(); ?>