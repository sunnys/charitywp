<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package thim
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if (
	have_comments() &&
	!( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) )
) {
	$class_has_comments = " has-comments";
} else {
	$class_has_comments = "";
}
?>

<div id="comments" class="comments-area<?php echo esc_attr( $class_has_comments ); ?>">
	<?php // You can start editing here -- including this comment!  ?>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'charitywp' ); ?></h1>

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'charitywp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'charitywp' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation  ?>


		<div class="comment-list-inner">
			<h2 class="comments-title">
				<?php
				printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'charitywp' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>
			<ol class="comment-list">
				<?php wp_list_comments( 'style=li&&type=comment&avatar_size=90&callback=thim_comment' ); ?>
			</ol>
			<!-- .comment-list -->
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'charitywp' ); ?></h1>

				<div class="nav-previous"><?php previous_comments_link( esc_html__('&larr; Older Comments', 'charitywp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'charitywp' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation  ?>
	<?php endif; // have_comments() ?>
	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments" style="background: #fff;padding: 30px;"><?php esc_attr_e( 'Comments are closed.', 'charitywp' ); ?></p>
	<?php endif; ?>
	<div class="comment-respond-area">
		<?php 
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
		  'author' =>
		    '<p class="comment-form-author">
		    	<input id="author" name="author" type="text" placeholder="'.esc_attr__( 'Name *', 'charitywp' ).'" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />
		    </p>',

		  'email' =>
		    '<p class="comment-form-email">
		    	<input id="email" name="email" type="text" placeholder="'.esc_attr__( 'Email *', 'charitywp' ).'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' />
		    </p>',

		  'url' =>
		    '<p class="comment-form-url">
		    	<input id="url" name="url" type="text" placeholder="'.esc_attr__( 'Website', 'charitywp' ).'" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" />
		    </p>',
		);

		$args = array(
		  'title_reply'       	=> esc_attr__( 'Leave a Reply', 'charitywp' ),
		  'label_submit'      	=> esc_attr__( 'Post Comment', 'charitywp' ),
		  'fields' 				=> apply_filters( 'comment_form_default_fields', $fields ),
		  'comment_field' 		=>  '<p class="comment-form-comment">
		  								<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_attr__( 'Comment *', 'charitywp' ).'"></textarea>
		  							</p>',
		);



		comment_form( $args ); ?>
	</div>
	<div class="clear"></div>

</div><!-- #comments -->
