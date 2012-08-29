<div id="respond">
<?php
# CHECKPOINT 2
if ('open' == $post->comment_status) : ?>
<?php
# CHECKPOINT 1
if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>Комментарии доступны только для зарегистрированных пользователей. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">Войдите</a>, чтобы оставить комментарий.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform" id="commentform">
<div id="commentuserdata">
<h3><?php comment_form_title('Ваш комментарий',  'Ответить %s' ); ?> 
</h3>

<?php if ( $user_ID ) : ?>	
<?php 
$user = wp_get_current_user(); 
#print_r($user) 
?>
<p>
	<span class="commentgravatar"><img class="avatar" src="<?php echo $user->loginza_avatar ?>" alt="<?php echo $user->display_name ?>" width="38" /></span> 
	<span class="autorname">Вы вошли как <a href="<?php echo $user->loginza_identity ?>"><?php echo $user->display_name ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Выход" class="logoutlink">Выйти »</a></span>
</p>
<? /* ?>
<p>Вы вошли как <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Выход" class="editlink">Выйти »</a></p>
*/ ?>
<?php else : ?>
<p>
<label for="author">Имя <small>(обязательно)</small></label>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
	<div class="clear"></div>
</p>
<p>
<label for="email">Почта <small>(обязательно)</small></label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
	<div class="clear"></div>
</p>
<?php 
/* 
<p>
<label for="url">Сайт</label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
	<div class="clear"></div>
</p>
*/ 
?>
<?php endif; ?>
</div> <!-- commentuserdata -->

<p><small><strong>XHTML:</strong> вы можете воспользоваться следующими тагами: <?php echo allowed_tags(); ?></small></p>

<p><textarea name="comment" id="comment"  rows="5" cols="45" tabindex="4"></textarea></p>

<p>
	<input name="submit" type="submit" class="comment-submit" tabindex="5" value="Отправить" />
	<span class="cancel-comment-reply"><?php cancel_comment_reply_link('Отменить'); ?></span>
</p>
	<div class="clear"></div>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
</div> <!-- commentformarea -->

<?php endif; // CHECKPOINT 1 : If registration required and not logged in ?>
<?php endif; // CHECKPOINT 2 : if you delete this the sky will fall on your head ?>
	<div class="clear"></div>
</div>