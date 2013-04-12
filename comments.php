<div class="comments mt20">
				<span class="comm-title"> <?php comments_number()?> </span>
				<div>
				<?php $comments = get_comments('post_id='.get_the_ID());?>
				<?php foreach ($comments as $comment) :?>
					<p class="perComment">
						<span><?php comment_author()?></span> says:
						<?php comment_text()?>
					</p>
					<?php endforeach;?>

				</div>
			</div>

			<div class="comments mt20">
			<?php
			$current_user = wp_get_current_user();
			if ( 0 != $current_user->ID ):?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<span class="comm-title"> comments </span>
					<div>
						<textarea name="comment" id="comment" class="comment-text"></textarea>
					</div>
					<input name="submit" type="submit" id="submit" value="Post Comment"
						class="input2" /> <input type="hidden" name="comment_post_ID"
						value="<?php echo $id; ?>" />
						<?php do_action('comment_form', $post->ID); ?>
				</form>
				<?php else:?>

				<p>
					You must be <a
						href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged
						in</a> to post a comment.
				</p>
				<?php endif;?>
			</div>
		</div>
	</div>