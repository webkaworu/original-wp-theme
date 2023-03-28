<?php
if ( post_password_required() ) {
	return;
}

$comment_count = get_comments_number();
?>

<div id="comments" class="comments_area <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments_title">
			<?= $comment_count; ?>件のコメント
		</h2>
		<ol class="comment_list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 30,
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol>

		<?php
			the_comments_pagination(
				array(
					'mid_size' => 0,
				)
			);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no_comments">コメントは受け付けていません。</p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'logged_in_as'       => null,
			'title_reply'        => 'COMMENT<small class="sub_title">コメントする</small>',
			'title_reply_before' => '<h2 id="reply_title" class="comments_title comment_reply_title">',
			'title_reply_after'  => '</h2>',
		)
	);
	?>

</div><!-- #comments -->
