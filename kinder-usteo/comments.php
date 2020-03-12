<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="kinder-comments-area comments-area">

	<?php

	if ( have_comments() ) :
		?>
		<h4 class="kinder-comments-title comments-title">
			<?php
			$kinder_comment_count = get_comments_number();
			if ( '1' === $kinder_comment_count ) {
				printf(
					esc_html__( 'Ответил на &ldquo;%1$s&rdquo;', 'kinder' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( 
					esc_html( _nx( '%1$s Ответили на &ldquo;%2$s&rdquo;', '%1$s Ответили на &ldquo;%2$s&rdquo;', $kinder_comment_count, 'comments title', 'kinder' ) ),
					number_format_i18n( $kinder_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h4>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list kinder-comment-list">
			<?php
			wp_list_comments( array(
				'style'          => 'ul',
				'short_ping'     => true,
				'avatar_size'	 => 50,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Комментарии закрыты', 'kinder' ); ?></p>
			<?php
		endif;

	endif;
	?>

	<div class="row justify-content-center">
		<div class="col-md-12">
			<?php $comments_args = array(
				'title_reply_before' => '<h5 id="reply-title" class="comment-reply-title kinder-comment-reply-title">',
				'title_reply_after' => '</h5>',
			); ?>
			<?php comment_form( $comments_args ); ?>
		</div>
	</div>

</div><!-- #comments -->
