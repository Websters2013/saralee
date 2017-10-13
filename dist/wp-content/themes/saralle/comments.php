<?php
/**
 * @package PNMG
 * @subpackage SLSG
 */

if ( ! function_exists( 'toolbox_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own toolbox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Toolbox 0.4
 */
function toolbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment vcard">
			
			  <div class="comment-author-img"><?php echo get_avatar( $comment, 75 ); ?></div>

			  <div class="comment__content">
				<div class="comment-author">
					<?php printf( __( '%s', 'themename' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
				<p class="moderation"><em><?php _e( 'Your comment is awaiting moderation.', 'themename' ); ?></em></p>
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						printf( __( '%1$s at %2$s', 'themename' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'themename' ), ' ' );
					?>
				</div>
			
				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>

			</div>

		</article>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'themename' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'themename'), ' ' ); ?></p>
	</li>
	<?php
			break;
	endswitch;
}
endif; // ends check for toolbox_comment()

?>

	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'themename' ); ?></div>
	</div>
	<?php return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php
            echo  __('Comments','themename');
			    //printf( _n( 'Comment (1)', 'Comments (%1$s)', get_comments_number(), 'themename' ),number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="section-heading"><?php _e( 'Comment navigation', 'themename' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themename' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themename' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'toolbox_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="section-heading"><?php _e( 'Comment navigation', 'themename' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themename' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themename' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

		<?php else : // or, if we don't have comments:

			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 * But only on posts! We don't really need the note on pages.
			 */
			if ( ! comments_open() && ! is_page() ) :
			?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'themename' ); ?></p>
			<?php endif; // end ! comments_open() && ! is_page() ?>


		<?php endif; ?>

	<?php endif; ?>
	
  <?php $args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
      'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" palaceholder="'.__('Your Name *', 'themename').'" size="30" tabindex="1" /></p>',
      'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" palaceholder="'.__('Your Email *', 'themename').'" size="30" tabindex="2" /></p>',
      'url'    => '' ) ),
      'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" tabindex="3" aria-required="true" palaceholder="'. __('Your Comment', 'themename').'"></textarea></p>',
	  'label_submit' => __( 'Submit', 'themename' ),
      'title_reply' => ''
  ); ?>
	<?php comment_form( $args ); ?>

</div><!-- #comments -->