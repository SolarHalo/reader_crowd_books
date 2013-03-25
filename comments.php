<?php if ( post_password_required() )
	return;
?>
<hr>
<div id="comments_area">
<?php if ( have_comments() ) : ?>
	<h2><?php comments_number(); ?></h2>

	<ul>
		<?php wp_list_comments(); ?>
	</ul>
	<!-- /commentlist -->

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments">'Comments are closed.'</p>
	<?php endif; ?>
<?php endif;?>

<?php comment_form(); ?>
</div>
<!-- /comments -->