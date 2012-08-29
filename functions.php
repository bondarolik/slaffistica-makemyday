<?php
# l10n
function theme_init(){
	load_theme_textdomain('slaffistica', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');


if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}

# Get image attachment with addiotional data
function get_the_image($attid, $specialsize) {
	if ($specialsize == NULL)
		$specialsize = "medium";
	
	$args = array(
		'post_type' => 'attachment',
		'include' => $attid
	);
	
	$att = get_posts($args);
	
	$image = wp_get_attachment_image_src($att[0]->ID, $specialsize, false);
	
	$data['url']				 = $image[0];
	$data['width']			 = $image[1];
	$data['height']		   = $image[2];
	$data['caption'] 		 = $att[0]->post_content;
	$data['title']		   = $att[0]->post_title;
	$data['description'] = $att[0]->post_excerpt;
	$data['guid']				 = $att[0]->guid;

	return $data;
}

# Get attachemnts for current post
function get_my_attachments($mypostid) {
	# Defining some attributes for use in template
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $mypostid,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	);
	/*
	$attimg = get_children(array(
	                    'post_parent'    => get_the_ID(),
	                    'post_type'      => 'attachment',
	                    'numberposts'    => 1,
	                    'post_mime_type' => 'image',
	                    'orderby' => 'menu_order',
	                    'order' => 'ASC'
	*/
	#echo get_the_ID();

	$attachments = get_posts($args);
	
	return $attachments;
}


# Rewrite <title> tag for better SEO
function seo_title() {
	global $post, $page, $paged;
	$sep = " | "; # Separator
	$newtitle = get_bloginfo('name'); # Default
	
	# Single page ########################################
	if (is_single() || is_page()) {
		$themeta = get_post_meta($post->ID, 'my_projects_value', true);
		switch ($themeta) {
			case 'freewalls':
				$pretitle = 'Бесплатный валлпапер: ';
			break;
			case 'chilentero':
				$pretitle = 'Чили вдоль и поперек: ';
			break;
			default:
				$pretitle = '';
				break;
		}
		$newtitle = $pretitle . single_post_title("", false); # default title 
	}
		
			
	# Category ########################################
	if (is_category())
		$newtitle = single_cat_title("", false);

	# Tag ########################################
	if (is_tag())
	 $newtitle = single_tag_title("", false);
	
	# Search results ########################################
	if (is_search())
	 $newtitle = "Результаты поиска: " . $s;
	
	# Taxonomy page ########################################
	if (is_tax()) { 
		$curr_tax = get_taxonomy(get_query_var('taxonomy'));
		$curr_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); # current term data
		# if it's term 
		if (!empty($curr_term)) {
			$newtitle = $curr_tax->label . $sep . $curr_term->name;
		} else {
			$newtitle = $curr_tax->label;
		}
	}

	# Add page number if necesary
	if ($paged >= 2 || $page >= 2)
			$newtitle .= $sep . sprintf('Страница %s', max($paged, $page));
			
	# Home & Front Page ########################################	
	if (is_home() || is_front_page()) {
		$newtitle = get_bloginfo('name') . $sep . get_bloginfo('description');
	} else {
		$newtitle .= " | " . get_bloginfo('name');
	}
	
	return $newtitle;
}

add_filter('wp_title', 'seo_title');


add_action('init', 'register_my_menus');
function register_my_menus() {
	register_nav_menus(
		array(
			'home-menu' => 'Главное меню',
			'index-menu' => 'Оглавление',
		)
	);
}


if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

function custom_excerpt($limit) {
	if ($limit == NULL) $limit = 100;
	$myexp = get_the_excerpt();
	if (strlen($myexp) > $limit) {
		$myexp = mb_substr($myexp, 0, $limit, 'UTF-8').'...';
	}
	#$myexp = utf8_encode($myexp);
	return $myexp;
}


# new shortcode for posting complete gallery directyly in post 
# without navigation by attachments
function photoessay() {
	$output = '';
	$attachments = get_my_attachments(get_the_ID());
	if ($attachments) {
		foreach ($attachments as $att) {
			if (wp_attachment_is_image($att->ID)) {
				#$image = get_the_image($att->ID, 'large');
				$image = get_the_image($att->ID, 'full');
				if ($image['width'] != 720) { $image = get_the_image($att->ID, 'large'); }
				# code split
				$output .= '
				<div class="imagebox">			
				<img src="'.$image['url'].'" alt="'.$image['title'].'" width="'.$image['width'].'" height="'.$image['height'].'" class="" />';
				if ($image['caption'] != "") { 
					$output .= '<span>'.$image['caption'].'</span>';
				} else {
					$output .= '<span>' . $image['title'] .'</span>';
				}
				$output .= '</div>';
			} # if image
		} # foreach
	} # if attachments
	return $output;					
}
add_shortcode('photoessay', 'photoessay');
add_filter('the_content', 'do_shortcode');


# widgets
if ( function_exists('register_sidebar') )
{
 	register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
    ));
}
?>
<?php 
function slaffistica_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="commentmetadata">
	<p><span class="commentgravatar"><a href="<?php comment_author_url(); ?>" rel="nofollow"><?php if(function_exists('get_avatar')) { echo get_avatar($comment, '38'); } ?></a></span> <span class="autorname"><?php /* comment_author_link();  */ comment_author(); ?></span> <a href="#comment-<?php comment_ID(); ?>" class="commentdate"><?php comment_date('M jS, Y') ?> @ <?php comment_time(); ?></a></p>
		<div class="clear"></div>
	</div> <!-- commentdata -->

	<div class="commenttext">
	  <?php if ($comment->comment_approved == '0') : ?>
		<p><em>Вы в первый раз оставили комментарий у меня в блоге. Поэтому сейчас ваш комментарий должен пройти проверку. Нет необходимости добавлять его дважды.</em></p>
	  <?php endif; ?>

    <?php comment_text() ?>
	</div> <!--commenttext -->

	<div class="comment-buttons">
   <?php edit_comment_link('Редактировать', '', ''); ?>
   <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Ответить', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
 <div class="clear"></div>	
<?php } ?>
<?php
function list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php } ?>