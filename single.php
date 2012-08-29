<?php get_header(); ?>

<?php get_sidebar(); ?>
<? /* leftcolumn starts at header.php */ ?>
</section> <!-- .leftcolumn -->

<section class="rightcolumn">
<?php include (TEMPLATEPATH . '/theloop.php'); ?>

<section class="commentlist">
<?php
#if (!in_category('2207')): 
	comments_template('', true);
#endif;
?>
</section> <!-- .comments -->
</section> <!-- .rightcolumn -->

<?php get_footer(); ?>